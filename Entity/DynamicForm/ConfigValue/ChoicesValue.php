<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\Choice;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Valid
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\Choice", cascade={"persist"})
     * @ORM\JoinTable(name="dynamic_form_choice_result_to_choices")
     */
    private $choices;

    /**
     */
    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    /**
     * @return Collection|Choice[]
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
        if (false === $this->choices->contains($choice)) {
            $this->choices[] = $choice;
        }

        return $this;
    }

    /**
     * @param Choice $choice
     */
    public function removeChoice(Choice $choice)
    {
        $this->choices->removeElement($choice);
    }

    public function __clone()
    {
        $choices = $this->choices->toArray();

        $this->choices = new ArrayCollection();
        $this->choices->clear();

        foreach ($choices as $choice) {
            $this->addChoice(clone $choice);
        }
    }
}
