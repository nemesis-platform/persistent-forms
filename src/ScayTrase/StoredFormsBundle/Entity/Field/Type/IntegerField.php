<?php
/**
 * User: scaytrase
 * Created: 2016-05-03 20:07
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field\Type;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormTypeInterface;

class IntegerField extends AbstractField
{
    /**
     * @return string|FormTypeInterface
     */
    protected function getRenderedFormType()
    {
        return IntegerType::class;
    }
}
