<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_option_value")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package DynamicFormBundle\Entity\Value
 */
abstract class BaseValue
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var OptionValue
     *
     * @ORM\OneToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue", inversedBy="value")
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $option;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return OptionValue
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param OptionValue $option
     */
    public function setOption(OptionValue $option)
    {
        $this->option = $option;
    }

    /**
     * @return mixed
     */
    abstract public function getContent();

    public function __clone()
    {
        $this->id = null;
    }
}
