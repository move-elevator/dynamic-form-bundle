<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option\Configuration;

use DynamicFormBundle\Admin\Form\Type\BaseType\ChoiceTextType;
use DynamicFormBundle\Admin\Services\FormField\Option\CollectionConfigurationInterface;
use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\ArrayValue;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\ChoicesValue;
use DynamicFormBundle\Statics\FormFieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option\Configuration
 */
class ChoicesConfiguration implements CollectionConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return ChoiceTextType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return ChoiceOptions::CHOICES;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return SymfonyFieldOptions::CHOICES;
    }

    /**
     * @return array
     */
    public function getDefaultValue()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return ChoicesValue::class;
    }
}