<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use Doctrine\Common\Collections\Collection;
use DynamicFormBundle\Entity\DynamicForm\Choice;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\ChoicesValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Admin\Services
 */
class ChoicesCleanup
{
    /**
     * @var FormField
     */
    private $formField;

    /**
     * @var Collection|Choice
     */
    private $defaultChoices;

    /**
     */
    public function checkRemoves()
    {
        if ($this->formField->hasOptionValues('choices')) {
            foreach ($this->defaultChoices as $choice) {
                $choiceValue = $this->formField->getOptionValue('choices')->getValue();

                $this->removeChoice($choiceValue, $choice);
            }
        }
    }

    /**
     * @param FormField $formField
     *
     * @return ChoicesCleanup
     */
    public function setFormField(FormField $formField)
    {
        if (true === $formField->hasOptionValues('choices')) {
            $this->defaultChoices = $formField
                ->getOptionValue('choices')
                ->getRealValue()
                ->toArray();
        }

        $this->formField = $formField;

        return $this;
    }

    /**
     * @param ChoicesValue $choicesValue
     * @param Choice       $choice
     */
    private function removeChoice(ChoicesValue $choicesValue, Choice $choice)
    {
        if (false === $choicesValue->getContent()->contains($choice)) {
            $choicesValue->removeChoice($choice);
        }
    }
}