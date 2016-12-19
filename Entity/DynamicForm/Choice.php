<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\ChoicesValue as ChoiceConfig;
use DynamicFormBundle\Entity\DynamicResult\ResultValue\ChoicesValue as ChoicesValue;
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
     * @var Collection|ChoiceConfig[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\ConfigValue\ChoicesValue", inversedBy="choices")
     * @ORM\JoinTable(name="dynamic_form_choice_config_to_choices")
     */
    private $choiceConfigs;

    /**
     * @var Collection|ChoicesValue[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicResult\ResultValue\ChoicesValue", inversedBy="choices")
     * @ORM\JoinTable(name="dynamic_form_choice_value_to_choices")
     */
    private $choiceValues;

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
     * @return ChoiceConfig[]
     */
    public function getChoiceConfigs()
    {
        return $this->choiceConfigs;
    }

    /**
     * @param ChoiceConfig $choiceConfig
     *
     * @return Choice
     */
    public function addChoiceConfig(ChoiceConfig $choiceConfig)
    {
        if (false === $this->choiceConfigs->contains($choiceConfig)) {
            $this->choiceConfigs[] = $choiceConfig;
        }

        return $this;
    }

    /**
     * @param ChoiceConfig $choiceConfig
     */
    public function removeChoiceConfig(ChoiceConfig $choiceConfig)
    {
        $this->choiceConfigs->removeElement($choiceConfig);
    }

    /**
     * @return ChoicesValue[]
     */
    public function getChoiceValues()
    {
        return $this->choiceValues;
    }

    /**
     * @param ChoicesValue $choiceConfig
     *
     * @return Choice
     */
    public function addChoiceValue(ChoicesValue $choiceConfig)
    {
        if (false === $this->choiceValues->contains($choiceConfig)) {
            $this->choiceValues[] = $choiceConfig;
        }

        return $this;
    }

    /**
     * @param ChoicesValue $choiceConfig
     */
    public function removeChoiceValue(ChoicesValue $choiceConfig)
    {
        $this->choiceValues->removeElement($choiceConfig);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getLabel();
    }
}