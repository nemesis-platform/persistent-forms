<?php

namespace ScayTrase\StoredFormsBundle\Form\Transformer;

use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 27.05.2015
 * Time: 16:42
 */
class ValueTransformer implements DataTransformerInterface
{
    /** @var  AbstractValue */
    private $value;

    /**
     * ValueTransformer constructor.
     *
     * @param AbstractValue $value
     */
    public function __construct(AbstractValue $value)
    {
        $this->value        = $value;
    }

    /** @inheritdoc */
    public function transform($original)
    {
        if (null === $original) {
            return null;
        }

        if ([] === $original) {
            return null;
        }

        if (!($original instanceof AbstractValue)) {
            var_dump('original', $original);
            throw new TransformationFailedException('Not an AbstractValue');
        }

        $this->value = $original;

        return $this->value->getValue();
    }

    /** @inheritdoc */
    public function reverseTransform($submitted)
    {
        var_dump('submitted', $submitted);

        if (null === $submitted) {
            return $this->value;
        }

        $this->value->setValue($submitted);

        return $this->value;
    }
}
