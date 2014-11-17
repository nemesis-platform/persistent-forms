<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 17.11.2014
 * Time: 16:44
 */

namespace ScayTrase\Forms\StorableFormsBundle\Tests;


use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use ScayTrase\Forms\StorableFormsBundle\Entity\FieldValue;
use ScayTrase\Forms\StorableFormsBundle\Form\Fields\CheckBoxArrayField;
use Symfony\Component\Form\Test\TypeTestCase;

class CheckBoxArrayFieldTest extends TypeTestCase
{
    public function testEmptyOperation()
    {

        $field = new CheckBoxArrayField($this->factory);
        $fe = new Field();
        $fe->setType($field->getType());
        $fe->setName('test_field');
        $fe->setOptions(
            array(
                'checkbox1' => 'title 1',
                'checkbox2' => 'title 2',
                'checkbox3' => 'title 3'
            )
        );

        $form_data = array(
            'checkbox1',
            'checkbox2',
        );

        $form = $field->getForm($fe)->getForm();

        $form->submit($form_data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($form_data, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($form_data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

        $fv = new FieldValue();
        $fv->setField($fe);
        $fv->setValue($field->convertValueToStored($form->getData(), $fe->getOptions()));
        $this->assertEquals(
            json_encode(array('title 1', 'title 2')),
            $fv->getValue()
        );
    }

    public function testDataRenewal()
    {
        $field = new CheckBoxArrayField($this->factory);
        $fe = new Field();
        $fe->setType($field->getType());
        $fe->setName('test_field');
        $fe->setOptions(
            array(
                'checkbox1' => 'title 1',
                'checkbox2' => 'title 2',
                'checkbox3' => 'title 3'
            )
        );

        $fv = new FieldValue();
        $fv->setField($fe);
        $fv->setValue(json_encode(array('title 3')));


        $form_data = array(
            'checkbox1',
            'checkbox3',
        );

        $form = $field->getForm($fe)->getForm();
        $form->setData($field->convertStoredToValue($fv->getValue(), $fe->getOptions()));

        $this->assertEquals(array('checkbox3'), $form->getData());

        $form->submit($form_data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(count($form_data), count($form->getData()));

        foreach ($form_data as $key) {
            $this->assertContains($key, $form->getData());
        }

        $fv->setValue($field->convertValueToStored($form->getData(), $fe->getOptions()));

        $this->assertEquals(
            json_encode(array('title 1', 'title 3')),
            $fv->getValue()
        );
    }
}
 