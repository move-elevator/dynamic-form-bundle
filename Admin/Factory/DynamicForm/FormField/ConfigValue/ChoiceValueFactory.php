<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm\FormField\ConfigValue;

use DynamicFormBundle\Admin\Factory\DynamicForm\FormField\ConfigValueFactoryInterface;
use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\Choice;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\ChoicesValue;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm\FormField\OptionValue
 */
class ChoiceValueFactory implements ConfigValueFactoryInterface
{
    public function create(ConfigurationInterface $configuration)
    {
        $value = new ChoicesValue();

        if (null === $configuration->getDefaultValue()) {
            $value->addChoice(new Choice());
        }

        if (true === is_array($configuration->getDefaultValue())) {
            $value->setContent($configuration->getDefaultValue());
        }

        return $value;
    }

    public function supports()
    {
        return ChoicesValue::class;
    }
}