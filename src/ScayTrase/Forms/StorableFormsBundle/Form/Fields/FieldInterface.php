<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:35
 */

namespace ScayTrase\Forms\StorableFormsBundle\Form\Fields;


use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Test\FormBuilderInterface;

interface FieldInterface {

    /** @return string field type */
    public function getType();

    /**
     * @param FormFactoryInterface $factory
     * @param Field $field
     * @param array $form_options
     * @return FormBuilderInterface
     */
    public function getForm(FormFactoryInterface $factory, Field $field,$form_options = array());

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertStoredToValue($value, $options = array());

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertValueToStored($value, $options = array());

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertStoredToView($value, $options = array());
} 