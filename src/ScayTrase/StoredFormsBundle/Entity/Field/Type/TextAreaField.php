<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 21:59
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;


use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Value\Type\TextValue;
use ScayTrase\StoredFormsBundle\Form\Transformer\ValueTransformer;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormTypeInterface;

class TextAreaField extends AbstractField
{
    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return TextareaType::class;
    }

    /**
     * @return DataTransformerInterface
     */
    protected function getValueTransformer()
    {
        return new ValueTransformer(new TextValue($this), 'textValue');
    }
}
