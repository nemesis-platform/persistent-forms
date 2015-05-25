<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 21:59
 */

namespace ScayTrase\StorableFormsBundle\Entity\Type;


use ScayTrase\StorableFormsBundle\Entity\AbstractField;
use Symfony\Component\Form\FormTypeInterface;

class TextAreaField extends AbstractField
{

    /**
     * @return FormTypeInterface|string FormTypeInterface instance or string which represents registered form type
     */
    public function getFormType()
    {
        return 'textarea';
    }

    /**
     * @return string Name key for the object
     */
    public function getType()
    {
        return 'field_textarea';
    }

    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return 'textarea';
    }

    /**
     * @return array
     */
    protected function getRenderedFormOptions()
    {
        return array();
    }
}
