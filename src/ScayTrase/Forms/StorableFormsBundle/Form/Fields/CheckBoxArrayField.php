<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 17.11.2014
 * Time: 16:28
 */

namespace ScayTrase\Forms\StorableFormsBundle\Form\Fields;


use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use Symfony\Component\Form\FormBuilderInterface;

class CheckBoxArrayField extends ChoiceField
{

    /**
     * @param Field $field
     * @param array $form_options
     * @return FormBuilderInterface
     */
    public function getForm(Field $field, $form_options = array())
    {
        return parent::getForm(
            $field,
            array_merge_recursive(array('expanded' => true, 'multiple' => true), $form_options)
        );
    }

    public function convertStoredToValue($value, $options = array())
    {
        $data = json_decode($value, true);
        $keys = array();
        foreach ($data as $title) {
            foreach ($options as $key => $option) {
                if ($option === $title) {
                    $keys[$key] = $key;
                    break;
                }
            }
        }

        return array_values($keys);
    }

    public function convertValueToStored($value, $options = array())
    {
        $result = array();

        foreach ($value as $key) {
            if (array_key_exists($key, $options)) {
                $result[] = $options[$key];
            }
        }
        sort($result);
        return json_encode($result);
    }

    public function convertStoredToView($value, $options = array())
    {
        return $value;
    }

    public function getType()
    {
        return 'field_choice_expanded';
    }

    public function getDescription()
    {
        return 'Расширенное поле выбора';
    }


} 