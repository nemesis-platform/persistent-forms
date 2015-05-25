<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:59
 */

namespace ScayTrase\StorableFormsBundle\Entity;


class FieldValue
{
    /** @var  int|null */
    private $id;
    /** @var  AbstractField */
    private $field;
    /** @var  mixed */
    private $value;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return AbstractField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param AbstractField $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


}
