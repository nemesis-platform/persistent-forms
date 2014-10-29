<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:38
 */

namespace ScayTrase\Forms\StorableFormsBundle\Form\Fields;


use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use Symfony\Component\Form\Test\FormBuilderInterface;

class ChoiceField extends AbstractField
{

    /** @return string field type */
    public function getType()
    {
        return 'field_choice';
    }

    /**
     * @param Field $field
     * @param array $form_options
     * @return FormBuilderInterface
     */
    public function getForm(Field $field, $form_options = array())
    {
        $builder = $this->getFactory()->createNamedBuilder(
            $field->getName(),
            'choice',
            null,
            array_merge_recursive(
                array(
                    'choices' => $field->getOptions(),
                    'label' => $field->getDescription(),
                    'attr' => array('help_text' => $field->getHelpMessage())
                ),
                $form_options
            )
        );

        return $builder;
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertStoredToView($value, $options = array())
    {
        if (array_key_exists($value, $options)) {
            return $options[$value];
        }

        return null;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Поле с вариантами выбора';
    }
}
