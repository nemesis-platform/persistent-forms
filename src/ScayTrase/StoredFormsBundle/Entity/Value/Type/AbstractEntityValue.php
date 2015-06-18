<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 26.05.2015
 * Time: 10:14
 */

namespace ScayTrase\StoredFormsBundle\Entity\Value\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\Type\AbstractEntityField;
use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;

abstract class AbstractEntityValue extends AbstractValue
{
    public function getRenderValue()
    {
        /** @var AbstractEntityField $field */
        $field = $this->getField();

        if (!($field instanceof AbstractEntityField)) {
            throw new \LogicException('Entity answer belongs to non-entity field');
        }

        return $field->renderEntity($this->getValue());
    }
}
