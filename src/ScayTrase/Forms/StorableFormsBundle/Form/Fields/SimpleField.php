<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:38
 */

namespace ScayTrase\Forms\StorableFormsBundle\Form\Fields;


use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Test\FormBuilderInterface;

class SimpleField extends AbstractField
{
    /** @return string field type */
    public function getType()
    {
        return 'field_simple';
    }

    /**
     * @param FormFactoryInterface $factory
     * @param Field $field
     * @param array $form_options
     * @return FormBuilderInterface
     */
    public function getForm(FormFactoryInterface $factory, Field $field, $form_options = array())
    {
        return $factory->createNamedBuilder(
            $field->getName(),
            'text',
            null,
            array_merge_recursive(
                array(
                    'label' => $field->getDescription(),
                    'attr' => array(
                        'help_text' => $field->getHelpMessage()
                    )
                ),
                $form_options
            )
        );
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed|void
     */
    public function convertStoredToValue($value, $options = array())
    {
        return $value;
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertValueToStored($value, $options = array())
    {
        return $value;
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertStoredToView($value, $options = array())
    {
        return $value;
    }
}