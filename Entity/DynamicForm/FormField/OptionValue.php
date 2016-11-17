<?php

namespace DynamicFormBundle\Entity\DynamicForm\FormField;

use DynamicFormBundle\Entity\Value\BaseValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_field_option")
 *
 * @package DynamicFormBundle\Entity
 */
class OptionValue
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
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\Value\BaseValue")
     * @ORM\JoinColumn(name="value_id", referencedColumnName="id", nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="option_name", type="string")
     */
    private $option;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param BaseValue $value
     *
     * @return OptionValue
     */
    public function setValue(BaseValue $value)
    {
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

    /**
     * @return mixed
     */
    public function getRealValue()
    {
        return $this->getValue()->getContent();
    }
}
