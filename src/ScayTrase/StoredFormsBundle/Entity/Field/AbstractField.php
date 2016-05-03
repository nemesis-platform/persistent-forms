<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 14:01
 */

namespace ScayTrase\StoredFormsBundle\Entity\Field;


use Ramsey\Uuid\Uuid;
use ScayTrase\Core\Form\FormTypedInterface;
use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;
use ScayTrase\StoredFormsBundle\Entity\Value\Type\PlainValue;
use ScayTrase\StoredFormsBundle\Form\Transformer\ValueTransformer;
use ScayTrase\StoredFormsBundle\Form\Type\AbstractFieldType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;

abstract class AbstractField implements FormTypedInterface
{
    /** @var  mixed|null */
    private $id;
    /** @var  string */
    private $name;
    /** @var  string */
    private $title;
    /** @var  string */
    private $help_message;
    /** @var  bool */
    private $required = true;

    /**
     * AbstractField constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->id   = Uuid::uuid4();
    }


    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /** @return string */
    public function __toString()
    {
        return $this->getName();
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
        return AbstractFieldType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $options = array_replace_recursive(
            array(
                'empty_data' => new PlainValue($this),
                'data_class' => AbstractValue::class,
                'required'   => $this->isRequired(),
                'label'      => $this->getTitle(),
                'attr'       => array('help_text' => $this->getHelpMessage()),
            ),
            $this->getRenderedFormOptions(),
            $options
        );

        $field = $builder->create($this->name, $this->getRenderedFormType(), $options);

        if (null !== ($transformer = $this->getValueTransformer())) {
            $field->addModelTransformer($transformer);
        }

        $builder->add($field);
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = (bool)$required;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: $this->name;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = (string)$title;
    }

    /**
     * @return string
     */
    public function getHelpMessage()
    {
        return $this->help_message;
    }

    /**
     * @return FormTypeInterface|string
     */

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
    protected function getRenderedFormOptions()
    {
        return [];
    }

    /**
     * @return string|FormTypeInterface
     */
    abstract protected function getRenderedFormType();


    /**
     * @return DataTransformerInterface
     */
    protected function getValueTransformer()
    {
        return new ValueTransformer(new PlainValue($this), 'value');
    }
}
