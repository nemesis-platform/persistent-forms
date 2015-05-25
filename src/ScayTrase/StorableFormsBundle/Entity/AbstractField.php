<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 14:01
 */

namespace ScayTrase\StorableFormsBundle\Entity;


use ScayTrase\Core\Form\FormTypedInterface;
use ScayTrase\Core\Registry\TypedObjectInterface;
use ScayTrase\StorableFormsBundle\Form\AbstractFieldType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;

abstract class AbstractField implements TypedObjectInterface, FormTypedInterface
{
    /** @var  int|null */
    private $id;
    /** @var  string */
    private $name;
    /** @var  string */
    private $title;
    /** @var  string */
    private $help_message;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return sprintf('"%s" %s', $this->getName(), $this->getType());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return FormTypeInterface|string FormTypeInterface instance or string which represents registered form type
     */
    public function getFormType()
    {
        return new AbstractFieldType();
    }

    public function buildForm(FormBuilderInterface $builder)
    {
        $options = array_replace_recursive(
            array(
                'label' => $this->getTitle(),
                'attr'  => array('help_text' => $this->getHelpMessage()),
            ),
            $this->getRenderedFormOptions()
        );

        $builder->add($this->name, $this->getRenderedFormType(), $options);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return FormTypeInterface|string
     */

    /**
     * @return string
     */
    public function getHelpMessage()
    {
        return $this->help_message;
    }

    /**
     * @param string $help
     */
    public function setHelpMessage($help)
    {
        $this->help_message = $help;
    }

    /**
     * @return array
     */
    abstract protected function getRenderedFormOptions();

    /**
     * @return string|FormTypeInterface
     */
    abstract protected function getRenderedFormType();
}
