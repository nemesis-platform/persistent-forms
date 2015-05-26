<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 21:50
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use Symfony\Component\Form\FormTypeInterface;

class NumberField extends AbstractField
{

    /**
     * @return FormTypeInterface|string FormTypeInterface instance or string which represents registered form type
     */
    public function getFormType()
    {
        return 'number';
    }

    /**
     * @return string Name key for the object
     */
    public function getType()
    {
        return 'field_number';
    }

    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return 'number';
    }

    /**
     * @return array
     */
    protected function getRenderedFormOptions()
    {
        return array(
            'property_path' => 'value',
            'data_class' => 'ScayTrase\StoredFormsBundle\Entity\Field\Value\Type\PlainValue',
        );
    }
}
