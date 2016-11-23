<?php

namespace DynamicFormBundle\Entity\DynamicForm\FormField;

use DynamicFormBundle\Model\DynamicForm\FormField\OptionValue as BaseModel;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BaseValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_field_option")
 *
 * @package DynamicFormBundle\Entity
 */
class OptionValue extends BaseModel
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var BaseValue
     *
     * @ORM\OneToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm\ConfigValue\BaseValue", mappedBy="option", cascade={"persist", "remove"})
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="field_option")
     */
    private $option;

    /**
     * @param string    $name
     * @param string    $option
     * @param BaseValue $value
     */
    public function __construct($name = null, $option = null, BaseValue $value = null)
    {
        $this->name = $name;
        $this->option = $option;
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * @param BaseValue $value
     *
     * @return OptionValue
     */
    public function setValue(BaseValue $value)
    {
        $value->setOption($this);
        $this->value = $value;

        return $this;
    }

    /**
     * @return BaseValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $option
     *
     * @return OptionValue
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }
}
