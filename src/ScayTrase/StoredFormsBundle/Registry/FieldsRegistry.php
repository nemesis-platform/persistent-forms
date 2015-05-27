<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:51
 */

namespace ScayTrase\StoredFormsBundle\Registry;

use ScayTrase\AutoRegistryBundle\Service\RegistryInterface;
use ScayTrase\Core\Registry\TypedObjectInterface;

class FieldsRegistry implements RegistryInterface
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
        $this->types[$offset] = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        unset($this->types[$offset]);
    }

    /**
     * @param string $type
     *
     * @return TypedObjectInterface
     */
    public function get($type)
    {
        return $this->types[$type];
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function has($type)
    {
        return array_key_exists($type, $this->types);
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
        $this->types[$object->getType()] = $object;
    }

    /**
     * @param TypedObjectInterface $object
     */
    public function add(TypedObjectInterface $object)
    {
        if (!array_key_exists($object->getType(), $this->types)) {
            $this->types[$object->getType()] = $object;
        }
    }

    /**
     * @param string $type
     */
    public function remove($type)
    {
        unset($this->types[$type]);
    }

    /**
     * @param TypedObjectInterface $object
     */
    public function removeElement(TypedObjectInterface $object)
    {
        unset($this->types[$object->getType()]);
    }

    /**
     * @return string[] All types stored at the registry
     */
    public function keys()
    {
        return array_keys($this->types);
    }
}
