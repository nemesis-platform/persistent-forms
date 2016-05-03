<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 22:07
 */

namespace ScayTrase\StoredFormsBundle\Form\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\Type\ChoiceField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceFieldType extends AbstractFieldType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('multiple', 'checkbox', array('required' => false));
        $builder->add('expanded', 'checkbox', array('required' => false));

        $builder->add(
            'choices',
            'collection',
            array(
                'entry_type'   => ChoiceFieldOptionType::class,
                'allow_add'    => true,
                'allow_delete' => true,
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(['data_class' => ChoiceField::class]);
    }
}
