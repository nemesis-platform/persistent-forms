<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 02.06.2015
 * Time: 13:40
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;

use Doctrine\Common\Collections\ArrayCollection;
use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Value\Type\TableValue;
use ScayTrase\StoredFormsBundle\Form\Transformer\ValueTransformer;
use ScayTrase\StoredFormsBundle\Form\Type\TableFieldType;
use ScayTrase\StoredFormsBundle\Form\Type\TableType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormTypeInterface;

class TableField extends AbstractField
{
    /** @var  ArrayCollection|AbstractField[] */
    private $fields;

    /**
     * TableField constructor.
     */
    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|AbstractField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    public function addField(AbstractField $field)
    {
        if (!$this->fields->contains($field)) {
            $this->fields->set($field->getName(), $field);
        }
    }

    public function removeField(AbstractField $field)
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);
        }
    }

    /**
     * @return string Name key for the object
     */
    public function getType()
    {
        return 'table_field';
    }

    public function getFormType()
    {
        return new TableFieldType(get_class($this));
    }

    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return new TableType();
    }

    /**
     * @return array
     */
    protected function getRenderedFormOptions()
    {
        return array_replace_recursive(
            parent::getRenderedFormOptions(),
            array(
                'options' => array(
                    'fields' => $this->fields->toArray(),
                ),
            )
        );

    }

    /**
     * @return DataTransformerInterface
     */
    protected function getValueTransformer()
    {
        $value = new TableValue();
        $value->setField($this);

        return new ValueTransformer($value, 'value');
    }
}
