<?php
/**
 * User: scaytrase
 * Created: 2016-05-03 20:12
 */

namespace ScayTrase\StoredFormsBundle\Tests;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Test\TypeTestCase;

abstract class AbstractFieldTest extends TypeTestCase
{
    /**
     * @dataProvider getTestData
     *
     * @param mixed $viewData
     * @param mixed $expectedData
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     * @throws \OutOfBoundsException
     */
    public function testField($viewData, $expectedData)
    {
        $field = $this->getField('test');

        $builder = $this->factory->createBuilder(FormType::class);
        $field->buildForm($builder);
        $form = $builder->getForm();

        self::assertTrue($form->has('test'));
        $form->submit(['test' => $viewData]);
        self::assertTrue($form->isSynchronized());
        self::assertTrue($form->isSubmitted());
        self::assertTrue($form->isValid());

        /** @var AbstractValue $value */
        $value = $form->get('test')->getData();
        self::assertInstanceOf(AbstractValue::class, $value);
        self::assertSame($expectedData, $value->getValue());
    }

    /** @return AbstractField */
    abstract protected function getField($alias);

    abstract protected function getTestData();
}
