<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 02.06.2015
 * Time: 14:07
 */

namespace ScayTrase\StoredFormsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TableType extends AbstractType
{
    public function getParent()
    {
        return 'collection';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $this->setDefaultOptions($resolver);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
//                'data_class'   => 'ScayTrase\StoredFormsBundle\Entity\Value\Type\TableValue',
//                'property'     => 'value',
                'type'         => new TableRowType(),
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
        return 'field_table';
    }
}
