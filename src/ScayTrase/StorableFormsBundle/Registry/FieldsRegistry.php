<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:51
 */

namespace ScayTrase\StorableFormsBundle\Registry;

use ScayTrase\AutoRegistryBundle\Service\RegistryInterface;
use ScayTrase\Core\Registry\TypedObjectInterface;
use ScayTrase\StorableFormsBundle\Entity\AbstractField;
use ScayTrase\StorableFormsBundle\Entity\FieldValue;

class FieldsRegistry implements RegistryInterface, StoreTransformerInterface, ViewTransformerInterface
{
    private $types = array();

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->types);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->types[$offset];
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->types = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        unset($this->types);
    }

    /**
     * @param string $type
     *
     * @return TypedObjectInterface
     */
    public function get($type)
    {
        return $this[$type];
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function has($type)
    {
        return isset($this[$type]);
    }

    /**
     * @return TypedObjectInterface[]
     */
    public function all()
    {
        return $this->types;
    }

    /**
     * @param TypedObjectInterface $object
     */
    public function replace(TypedObjectInterface $object)
    {
        $this[$object->getType()] = $object;
    }

    /**
     * @param TypedObjectInterface $object
     */
    public function add(TypedObjectInterface $object)
    {
        if (!array_key_exists($object->getType(), $this->types)) {
            $this[$object->getType()] = $object;
        }
    }

    /**
     * @param string $type
     */
    public function remove($type)
    {
        unset($this[$type]);
    }

    /**
     * @param TypedObjectInterface $object
     */
    public function removeElement(TypedObjectInterface $object)
    {
        unset($this[$object->getType()]);
    }

    /**
     * @return string[] All types stored at the registry
     */
    public function keys()
    {
        return array_keys($this->types);
    }

    /**
     * @param FieldValue $stored
     *
     * @return mixed
     */
    public function transformStoredToModel(FieldValue $stored)
    {
        $field = $stored->getField();
        if ($field instanceof StoreTransformerInterface) {

        }
    }

    /**
     * @param AbstractField $field
     * @param mixed         $model
     *
     * @return FieldValue
     */
    public function transformModelToStored(AbstractField $field, $model)
    {
        // TODO: Implement transformModelToStored() method.
    }

    /**
     * @param FieldValue $value
     *
     * @return mixed
     */
    public function transformStoredToView(FieldValue $value)
    {
        // TODO: Implement transformStoredToView() method.
    }
}
