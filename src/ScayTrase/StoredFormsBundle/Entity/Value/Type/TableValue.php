<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 02.06.2015
 * Time: 14:47
 */

namespace ScayTrase\StoredFormsBundle\Entity\Value\Type;

use Doctrine\Common\Collections\ArrayCollection;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\TableField;
use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;

class TableValue extends AbstractValue implements \ArrayAccess, \IteratorAggregate
{
    /** @var  TableRow[]|ArrayCollection */
    private $rows;

    /**
     * TableValue constructor.
     *
     * @param TableField $field
     * @param mixed      $value
     */
    public function __construct(TableField $field, $value = null)
    {
        parent::__construct($field, $value);
        $this->rows = new ArrayCollection();
    }

    public function getValue()
    {
        $values = array();
        foreach ($this->rows as $row) {
            $valueRow = array();
            foreach ($row->getValues() as $value) {
                $valueRow[$value->getField()->getName()] = $value;
            }
            $values[] = $valueRow;
        }

        return $values;
    }

    public function setValue($value)
    {
        $rows  = array();
        if (!is_array($value)) {
            $value = [$value];
        }
        foreach ($value as $row) {
            $tableRow = new TableRow($this);
            $tableRow->setValues($row);
            $rows[] = $tableRow;
        }
        $this->rows = new ArrayCollection($rows);
    }

    public function getHeaders()
    {
        $headers = array();

        /** @var TableField $field */
        $field = $this->getField();

        if (!($field instanceof TableField)) {
            throw new \LogicException('Table value belongs to non-table field');
        }

        foreach ($field->getFields() as $tableField) {
            $headers[$tableField->getName()] = $tableField->getTitle();
        }

        return $headers;
    }

    public function getRenderValue()
    {
        $result = array();

        foreach ($this->rows as $row) {
            $resultRow = array();
            foreach ($row->getValues() as $value) {
                $resultRow[$value->getField()->getName()] = $value->getRenderValue();
            }
            $result[] = $resultRow;
        }

        return $result;
    }

    /** @inheritdoc */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->rows);
    }

    /** @inheritdoc */
    public function offsetGet($offset)
    {
        return $this->rows[$offset];
    }

    /** @inheritdoc */
    public function offsetSet($offset, $value)
    {
        $this->rows[$offset] = $value;
    }

    /** @inheritdoc */
    public function offsetUnset($offset)
    {
        unset($this->rows[$offset]);
    }

    /** @inheritdoc */
    public function getIterator()
    {
        return new \ArrayIterator($this->rows);
    }
}
