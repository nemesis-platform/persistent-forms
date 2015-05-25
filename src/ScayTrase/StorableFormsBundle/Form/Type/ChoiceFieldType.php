<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 22:07
 */

namespace ScayTrase\StorableFormsBundle\Form\Type;

use ScayTrase\StorableFormsBundle\Form\AbstractFieldType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoiceFieldType extends AbstractFieldType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('choices', 'key_value_collection');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array('data_class' => 'ScayTrase\StorableFormsBundle\Entity\Type\ChoiceField'));
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'field_choice_settings';
    }
}
