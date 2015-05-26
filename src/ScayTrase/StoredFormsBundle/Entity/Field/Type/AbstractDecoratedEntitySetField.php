<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 26.05.2015
 * Time: 10:19
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;


use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use Symfony\Component\Form\ChoiceList\ChoiceListInterface;
use Symfony\Component\Form\FormTypeInterface;

abstract class AbstractDecoratedEntitySetField extends AbstractField
{
    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return 'entity';
    }

    /**
     * @return array
     */
    protected function getRenderedFormOptions()
    {
        return array(
            'data_class'  => 'ScayTrase\StoredFormsBundle\Entity\Field\Value\Type\AbstractDecoratedEntityValue',
            'choice_list' => $this->getChoiceList(),
        );
    }

    /**
     * @return ChoiceListInterface
     */
    abstract public function getChoiceList();
}
