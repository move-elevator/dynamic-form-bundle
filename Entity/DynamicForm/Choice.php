<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_choice")
 *
 * @package DynamicFormBundle\Entity\DynamicForm
 */
class Choice
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
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $label;

    /**
     * @var string
     *
     * @Assert\NotNull
     *
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @param string $label
     * @param string $value
     */
    public function __construct($label = null, $value = null)
    {
        $this->label = $label;
        $this->value = $value;

        $this->choiceConfigs = new ArrayCollection();
        $this->choiceValues = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getLabel();
    }
}