<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\Choice;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_choices_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class ChoicesValue extends BaseValue
{
    /**
     * @var Collection|Choice[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\Choice", mappedBy="choiceValues", cascade={"persist", "remove"}, fetch="EAGER")
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
        return $this->choices->toArray();
    }

    /**
     * @param array $content
     */
    public function setContent(array $content)
    {
        foreach ($this->choices as $choice) {
            if (false === in_array($choice, $content, true)) {
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
        $choice->addChoiceValue($this);

        if (false === $this->choices->contains($choice)) {
            $this->choices[$choice->getLabel()] = $choice;
        }

        return $this;
    }

    /**
     * @param Choice $choice
     */
    public function removeChoice(Choice $choice)
    {
        $choice->removeChoiceValue($this);
        $this->choices->removeElement($choice);
    }
}
