<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 26.05.2015
 * Time: 10:04
 */

namespace ScayTrase\StoredFormsBundle\Entity\Value\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\Type\ChoiceField;

class ChoiceValue extends PlainValue
{
    /**
     * @inheritdoc
     */
    public function getRenderValue()
    {
        /** @var ChoiceField $field */
        $field = $this->getField();

        if (!($field instanceof ChoiceField)) {
            throw new \LogicException('Choice answer belongs to non-choice field');
        }

        $choices = $field->getChoices();

        return $choices[$this->getValue()];
    }

}
