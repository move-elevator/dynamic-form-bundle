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
        if (true === $this->formField->hasOptionValues('choices')) {
            /** @var ChoicesValue $choicesValue */
            $choicesValue = $this->formField->getOptionValue('choices')->getValue();

            foreach ($this->defaultChoices as $choice) {
                $this->removeChoice($choicesValue, $choice);
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
