<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:51
 */

namespace ScayTrase\Forms\StorableFormsBundle\Services;


use LogicException;
use ScayTrase\AutoRegistryBundle\Service\RegistryElementInterface;
use ScayTrase\AutoRegistryBundle\Service\RegistryInterface;
use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use ScayTrase\Forms\StorableFormsBundle\Entity\FieldValue;
use ScayTrase\Forms\StorableFormsBundle\Form\Fields\FieldInterface;

class StorableFieldsRegistry implements RegistryInterface
{
    /** @var FieldInterface[] */
    private $fields = array();

    public function convertStoredToValue(FieldValue $value)
    {
        return $this->getByField($value->getField())->convertStoredToValue(
            $value->getValue(),
            $value->getField()->getOptions()
        );
    }

    /**
     * @param Field $field
     * @return FieldInterface
     */
    public function getByField(Field $field)
    {
        return $this->get($field->getType());
    }

    /**
     * @param $key string
     * @return FieldInterface
     */
    public function get($key)
    {
        if (!array_key_exists($key, $this->fields)) {
            throw new LogicException("Field {$key} not found");
        }

        return $this->fields[$key];
    }

    public function convertValueToStored(Field $field, $value)
    {
        return $this->getByField($field)->convertValueToStored($value, $field->getOptions());
    }

    public function convertStoredToView(FieldValue $value)
    {
        return $this->getByField($value->getField())->convertStoredToView(
            $value->getValue(),
            $value->getField()->getOptions()
        );
    }

    /** @return RegistryElementInterface[] */
    public function all()
    {
        return $this->fields;
    }

    /**
     * @param $key string
     * @return RegistryElementInterface
     */
    public function has($key)
    {
        return array_key_exists($key, $this->fields);
    }

    /**
     * @param RegistryElementInterface $element
     */
    public function add(RegistryElementInterface $element)
    {
        if (array_key_exists($element->getType(), $this->fields)) {
            throw new LogicException("Field {$element->getType()} already registered");
        }

        $this->fields[$element->getType()] = $element;
    }

    /**
     * @param RegistryElementInterface $element
     */
    public function remove(RegistryElementInterface $element)
    {
        if (!array_key_exists($element->getType(), $this->fields)) {
            throw new LogicException("Field {$element->getType()} not registered");
        }

        unset($this->fields[$element->getType()]);
    }
}
