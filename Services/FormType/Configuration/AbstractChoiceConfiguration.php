<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicForm\Choice;
use DynamicFormBundle\Services\FormType\ChoiceConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\ChoiceOptions;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
abstract class AbstractChoiceConfiguration implements ChoiceConfigurationInterface
{
    /**
     * @return \Closure
     */
    public function getChoiceLabelFunction()
    {
        return function(Choice $choice) {
            return $choice->getValue();
        };
    }

    /**
     * @return \Closure
     */
    public function getChoiceValueFunction()
    {
        return function($choice) {
            return $choice;
        };
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return ChoiceOptions::all();
    }

}