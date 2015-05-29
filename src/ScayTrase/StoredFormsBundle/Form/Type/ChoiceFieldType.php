<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 22:07
 */

namespace ScayTrase\StoredFormsBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class ChoiceFieldType extends AbstractFieldType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('multiple', 'checkbox', array('required' => false));
        $builder->add('expanded', 'checkbox', array('required' => false));

        $builder->add(
            'choices',
            'key_value_collection',
            array(
                'options'      => array('attr' => array('style' => 'inline')),
                'allow_add'    => true,
                'allow_delete' => true,
            )
        );
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
