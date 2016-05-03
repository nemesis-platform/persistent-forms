<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 02.06.2015
 * Time: 15:43
 */

namespace ScayTrase\StoredFormsBundle\Tests;

use ScayTrase\StoredFormsBundle\Entity\Field\Type\ChoiceField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\StringField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\TableField;
use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;

class TableFieldPersistenceTest extends AbstractKernelTest
{

    public function testSubFieldsDuplicateHandled()
    {
        $string = new StringField('string_type');
        $string->setTitle('String field');
        self::$em->persist($string);

        $table = new TableField('table_type');
        $table->addField($string);
        $table->addField($string);
        self::$em->persist($table);

        self::$em->flush();
    }

    public function testSubFieldsWithEqualNamesHandled()
    {
        $string1 = new StringField('string_type');
        $string1->setTitle('String field 1');
        self::$em->persist($string1);

        $string2 = new StringField('string_type');
        $string2->setTitle('String field 2');
        self::$em->persist($string2);

        $table = new TableField('table_type');
        $table->addField($string1);
        $table->addField($string2);
        self::$em->persist($table);

        self::$em->flush();
    }

    public function testTablePersistence()
    {
        $manager = self::$em;

        $string = new StringField('string_type');
        $string->setTitle('String field');
        $manager->persist($string);


        $choice = new ChoiceField('choice_type');
        $choice->setChoices(array('v1' => 'choice1', 'v2' => 'choice2'));
        $choice->setTitle('Choice field');
        $manager->persist($choice);

        $table = new TableField('table_type');
        $table->addField($string);
        $table->addField($choice);
        $manager->persist($table);

        $manager->flush();
        $manager->clear();

        /** @var TableField $fields */
        $field = $manager->getRepository(TableField::class)->findOneBy(['name' => 'table_type']);
        self::assertNotNull($field);

        /** @var FormBuilderInterface $builder */
        $builder = $this->getContainer()->get('form.factory')->createBuilder(FormType::class);

        $field->buildForm($builder);

        $form = $builder->getForm();

        $data = array(
            'table_type' => array(
                array(
                    'choice_type' => 'v1',
                    'string_type' => 'First string',
                ),
                array(
                    'choice_type' => 'v2',
                    'string_type' => 'Second string',
                ),
                array(
                    'choice_type' => 'v1',
                    'string_type' => 'Third string',
                ),
            ),
        );

        $form->submit($data);
        self::assertTrue($form->isSynchronized());

        $values = $form->getData();

        self::assertCount(1, $values);

        foreach ($values as $value) {
            $manager->persist($value);
        }

        $manager->flush();
        $manager->clear();

        $stored = $manager->getRepository(AbstractValue::class)->findBy(array('field' => $field));
        self::assertCount(1, $stored);
        self::assertCount(3, $stored[0]->getValue());

        foreach ($stored[0]->getValue() as $row) {
            self::assertTrue(is_array($row));
            self::assertCount(2, $row);
        }

        $values = array();
        foreach ($stored as $value) {
            $values[$value->getField()->getName()] = $value;
        }

        $builder = $this->getContainer()->get('form.factory')->createBuilder(FormType::class);
        $field->buildForm($builder);
        $form = $builder->getForm();

        $form->setData($values);
        self::assertTrue($form->isSynchronized());

        $form->submit($data);

        self::assertTrue($form->isSynchronized());
        self::assertTrue($form->isValid());
    }
}
