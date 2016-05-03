<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 22.06.2015
 * Time: 13:08
 */

namespace ScayTrase\StoredFormsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChoiceFieldOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('key', 'text', array('required' => false));
        $builder->add('value', 'text', array('required' => true));
        $builder->add('optgroup', 'text', array('required' => false));
    }
}
