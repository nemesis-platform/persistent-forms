<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-27
 * Time: 23:49
 */

namespace ScayTrase\StoredFormsBundle\Tests;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\ChoiceField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\NumberField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\StringField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\TextAreaField;
use Symfony\Component\Form\Test\TypeTestCase;

class StoredFormsTest extends TypeTestCase
{
    public function testTransformations()
    {
        $string = new StringField();
        $string->setName('string_type');

        $text = new TextAreaField();
        $text->setName('text_type');

        $number = new NumberField();
        $number->setName('number_type');

        $choice = new ChoiceField();
        $choice->setName('choice_type');
        $choice->setChoices(array('choice1', 'choice2'));

        /** @var AbstractField[] $fields */
        $fields = array($string, $text, $number, $choice);

        $builder = $this->factory->createBuilder('form');

        foreach ($fields as $field) {
            $field->buildForm($builder);
        }

        $data = array(
            'string_type' => 'the string to test',
            'text_type'   => 'Some text goes here',
            'number_type' => 1,
            'choice_type' => 0,
        );

        $form = $builder->getForm();
        $form->submit($data);

        self::assertTrue($form->isSynchronized());

        $this->assertInstanceOf(
            'ScayTrase\StoredFormsBundle\Entity\Value\Type\PlainValue',
            $form->get('string_type')->getData()
        );
        $this->assertEquals('the string to test', $form->get('string_type')->getData()->getValue());

        $this->assertInstanceOf(
            'ScayTrase\StoredFormsBundle\Entity\Value\Type\TextValue',
            $form->get('text_type')->getData()
        );
        $this->assertEquals('Some text goes here', $form->get('text_type')->getData()->getValue());

        $this->assertInstanceOf(
            'ScayTrase\StoredFormsBundle\Entity\Value\Type\PlainValue',
            $form->get('number_type')->getData()
        );
        $this->assertEquals(1, $form->get('number_type')->getData()->getValue());
        $this->assertTrue(1.0 === $form->get('number_type')->getData()->getValue());

        $this->assertInstanceOf(
            'ScayTrase\StoredFormsBundle\Entity\Value\Type\PlainValue',
            $form->get('choice_type')->getData()
        );

        $this->assertEquals(0, $form->get('choice_type')->getData()->getValue());
        $this->assertEquals('choice1', $form->get('choice_type')->getData()->getRenderValue());
    }
}
