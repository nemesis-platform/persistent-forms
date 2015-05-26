<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 26.05.2015
 * Time: 11:03
 */

namespace ScayTrase\StoredFormsBundle\Entity\Value\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\Type\AbstractDecoratedEntitySetField;
use ScayTrase\StoredFormsBundle\Entity\Field\Value\AbstractValue;

abstract class AbstractDecoratedEntityValue extends AbstractValue
{
    public function getRenderValue()
    {
        /** @var AbstractDecoratedEntitySetField $field */
        $field = $this->getField();

        if (!($field instanceof AbstractDecoratedEntitySetField)) {
            throw new \LogicException('Entity-set answer belongs to non-entity-set field');
        }

        foreach ($field->getEntities() as $element) {
            if ($this->getValue() === $element['entity']) {
                return $element['label'];
            }
        }

        return null;
    }
}
