<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 21:49
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Value\Type\ChoiceValue;
use ScayTrase\StoredFormsBundle\Form\Transformer\ValueTransformer;
use ScayTrase\StoredFormsBundle\Form\Type\ChoiceFieldType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormTypeInterface;

class ChoiceField extends AbstractField
{
    /** @var  array */
    private $choices;
    /** @var bool */
    private $expanded = false;
    /** @var bool */
    private $multiple = false;

    /**
     * @return boolean
     */
    public function isExpanded()
    {
        return $this->expanded;
    }

    /**
     * @param boolean $expanded
     */
    public function setExpanded($expanded)
    {
        $this->expanded = $expanded;
    }

    /**
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return string Name key for the object
     */
    public function getType()
    {
        return 'choice_field';
    }

    /**
     * @return array
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param array $choices
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;
    }

    /**
     * @return FormTypeInterface|string FormTypeInterface instance or string which represents registered form type
     */
    public function getFormType()
    {
        return 'field_choice_settings';
    }

    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return 'choice';
    }

    /**
     * @return array
     */
    protected function getRenderedFormOptions()
    {
        return array_replace_recursive(
            parent::getRenderedFormOptions(),
            array(
                'choices' => $this->choices,
                'expanded' => $this->expanded,
                'multiple' => $this->multiple
            )
        );

    }

    /**
     * @return DataTransformerInterface
     */
    protected function getValueTransformer()
    {
        $value = new ChoiceValue();
        $value->setField($this);

        return new ValueTransformer($value, 'value');
    }
}
