<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 26.05.2015
 * Time: 10:09
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Form\Type\AbstractEntityFieldType;
use Symfony\Component\Form\FormTypeInterface;

abstract class AbstractEntityField extends AbstractField
{
    /**
     * @return mixed
     */
    abstract public function getClassname();

    abstract public function renderEntity($entity);

    public function getFormType()
    {
        return new AbstractEntityFieldType(get_class());
    }

    /**
     * @return array
     */
    protected function getRenderedFormOptions()
    {
        return array(
            'data_class' => 'ScayTrase\StoredFormsBundle\Entity\Value\Type\AbstractEntityValue',
            'class' => $this->getClassname()
        );
    }

    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return 'entity';
    }
}
