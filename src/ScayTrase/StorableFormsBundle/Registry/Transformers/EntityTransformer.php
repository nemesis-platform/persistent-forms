<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 23:07
 */

namespace ScayTrase\StorableFormsBundle\Registry\Transformers;


use Doctrine\ORM\EntityManagerInterface;
use ScayTrase\StorableFormsBundle\Entity\AbstractField;
use ScayTrase\StorableFormsBundle\Entity\EntityBackendFieldInterface;
use ScayTrase\StorableFormsBundle\Entity\FieldValue;
use ScayTrase\StorableFormsBundle\Registry\StoreTransformerInterface;

class EntityTransformer implements StoreTransformerInterface
{
    /** @var  EntityManagerInterface */
    private $manager;

    /**
     * EntityTransformer constructor.
     *
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param FieldValue $stored
     *
     * @return mixed
     */
    public function transformStoredToModel(FieldValue $stored)
    {
        $field = $stored->getField();
        $value = $stored->getValue();
        if ($field instanceof EntityBackendFieldInterface) {
            $value = $this->manager->getRepository($field->getClassName())->find($value);
        }

        return $value;
    }

    /**
     * @param AbstractField $field
     * @param mixed         $model
     *
     * @return FieldValue
     */
    public function transformModelToStored(AbstractField $field, $model)
    {
        $stored = new FieldValue();
        $stored->setField($field);

        if (method_exists($model, 'getId')) {
            $stored->setValue($model->getId());
        } else {
            $stored->setValue((string)$model);
        }

        return $stored;
    }
}
