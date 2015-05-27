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
    /** @var  string */
    private $propertyPath;

    /**
     * ValueTransformer constructor.
     *
     * @param AbstractValue $value
     * @param string        $propertyPath
     */
    public function __construct(AbstractValue $value, $propertyPath)
    {
        $this->value        = $value;
        $this->propertyPath = $propertyPath;
    }

    /** @inheritdoc */
    public function transform($value)
    {
        // TODO: Implement transform() method.
    }

    /** @inheritdoc */
    public function reverseTransform($value)
    {
        // TODO: Implement reverseTransform() method.
    }

}
