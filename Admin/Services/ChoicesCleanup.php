<?php

namespace DynamicFormBundle\Admin\Services;

use DynamicFormBundle\Entity\DynamicForm\Choice;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\ChoicesValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Admin\Services
 */
class ChoicesCleanup
{
    /**
     * @param FormField  $formField
     * @param array      $choices
     */
    public function checkRemoves(FormField $formField, array $choices)
    {
        if ($formField->hasOptionValues('choices')) {
            foreach ($choices as $choice) {
                $choiceValue = $formField->getOptionValue('choices')->getValue();

                $this->removeChoice($choiceValue, $choice);
            }
        }
    }

    /**
     * @param ChoicesValue $choicesValue
     * @param Choice       $choice
     */
    private function removeChoice(ChoicesValue $choicesValue, Choice $choice)
    {
        if (false === $choicesValue->getContent()->contains($choice)) {
            $choice->removeChoiceConfig($choicesValue);
        }
    }
}