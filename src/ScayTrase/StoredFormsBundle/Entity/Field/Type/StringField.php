<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 21:54
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormTypeInterface;

class StringField extends AbstractField
{
    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return TextType::class;
    }
}
