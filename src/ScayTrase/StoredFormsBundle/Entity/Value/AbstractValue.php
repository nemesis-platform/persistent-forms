<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:59
 */

namespace ScayTrase\StoredFormsBundle\Entity\Value;


use Ramsey\Uuid\Uuid;
use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;

abstract class AbstractValue
{
    /** @var  int|null */
    private $id;
    /** @var  AbstractField */
    private $field;

    /**
     * AbstractValue constructor.
     *
     * @param AbstractField $field
     * @param mixed         $value
     */
    public function __construct(AbstractField $field, $value = null)
    {
        $this->id    = Uuid::uuid4();
        $this->field = $field;
        $this->setValue($value);
    }


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

    abstract public function getValue();

    abstract public function setValue($value);

    abstract public function getRenderValue();
}
