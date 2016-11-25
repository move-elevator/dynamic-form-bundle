<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\Choice;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_option_choice_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class ChoicesValue extends BaseValue
{
    /**
     * @var Collection|Choice[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\Choice", mappedBy="choiceConfigs", cascade={"persist", "remove"})
     */
    private $choices;

    /**
     */
    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->choices;
    }

    /**
     * @param Collection $content
     */
    public function setContent(Collection $content)
    {
        foreach ($this->choices as $choice) {
            if (false === $content->contains($choice)) {
                $this->removeChoice($choice);
            }
        }

        foreach ($content as $choice) {
            $this->addChoice($choice);
        }
    }

    /**
     * @param Choice $choice
     *
     * @return ChoicesValue
     */
    public function addChoice(Choice $choice)
    {
        $choice->addChoiceConfig($this);

        if (false === $this->choices->contains($choice)) {
            $this->choices[] = $choice;
        }

        return $this;
    }

    /**
     * @param Choice $field
     */
    public function removeChoice(Choice $field)
    {
        $field->removeChoiceConfig($this);
        $this->choices->removeElement($field);
    }
}
