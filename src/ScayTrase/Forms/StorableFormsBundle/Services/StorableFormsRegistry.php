<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:51
 */

namespace ScayTrase\Forms\StorableFormsBundle\Services;


use LogicException;
use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use ScayTrase\Forms\StorableFormsBundle\Entity\FieldValue;
use ScayTrase\Forms\StorableFormsBundle\Form\Fields\FieldInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StorableFormsRegistry
{
    /** @var ContainerInterface */
    private $container;
    /** @var FieldInterface[] */
    private $fields = array();

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function registerField(FieldInterface $field)
    {
        if (array_key_exists($field->getType(), $this->fields)) {
            throw new LogicException("Field {$field->getType()} already registered");
        }

        $this->fields[$field->getType()] = $field;
    }

    public function getFieldTypes()
    {
        return array_keys($this->fields);
    }

    public function convertStoredToValue(FieldValue $value)
    {
        $field = $this->getField($value->getField());

        return $field->convertStoredToValue($value->getValue(), $value->getField()->getOptions());
    }

    /**
     * @param Field $field
     * @return FieldInterface
     */
    public function getField(Field $field)
    {
        if (!array_key_exists($field->getType(), $this->fields)) {
            throw new LogicException("Field {$field->getType()} not found");
        }

        return $this->fields[$field->getType()];
    }

    public function convertValueToStored(Field $field, $value)
    {
        $ftype = $this->getField($field);

        return $ftype->convertValueToStored($value, $field->getOptions());
    }

    public function convertStoredToView(FieldValue $value)
    {
        $field = $this->getField($value->getField());

        return $field->convertStoredToView($value->getValue(), $value->getField()->getOptions());
    }

    /**
     * @param string $type
     * @return FieldInterface
     */
    public function getFieldByType($type)
    {
        if (!array_key_exists($type, $this->fields)) {
            throw new LogicException("Field {$type} not found");
        }

        return $this->fields[$type];
    }
} 