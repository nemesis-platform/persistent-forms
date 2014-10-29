<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 14:01
 */

namespace ScayTrase\Forms\StorableFormsBundle\Entity;


class Field
{
    /** @var  int|null */
    private $id;
    /** @var  string */
    private $name;
    /** @var  string */
    private $type;
    /** @var  string */
    private $description;
    /** @var  array */
    private $options = array();
    /** @var  string */
    private $help_message;

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
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


} 