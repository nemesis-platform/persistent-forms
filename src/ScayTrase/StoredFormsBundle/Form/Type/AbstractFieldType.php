<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 17:57
 */

namespace ScayTrase\StoredFormsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AbstractFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label' => 'Код поля'));
        $builder->add('title', 'text', array('label' => 'Описание'));
        $builder->add('required', 'checkbox', array('required' => false));
        $builder->add('help_message', 'textarea', array('label' => 'Подсказка', 'required' => false));
    }
}
