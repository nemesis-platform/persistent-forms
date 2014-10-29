<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:35
 */

namespace ScayTrase\Forms\StorableFormsBundle\Form\Fields;


use Symfony\Component\Form\FormFactoryInterface;

abstract class AbstractField implements FieldInterface
{
    /** @var  FormFactoryInterface */
    private $factory;

    function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed|void
     */
    public function convertStoredToValue($value, $options = array())
    {
        return $value;
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertValueToStored($value, $options = array())
    {
        return $value;
    }

    /**
     * @param $value mixed
     * @param array $options
     * @return mixed
     */
    public function convertStoredToView($value, $options = array())
    {
        return $value;
    }

}
