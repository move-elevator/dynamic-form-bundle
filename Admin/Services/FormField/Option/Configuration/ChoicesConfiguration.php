<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option\Configuration;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\Value\ArrayValue;
use DynamicFormBundle\Statics\FormFieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option\Configuration
 */
class ChoicesConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return TextType::class;
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
        return [];
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return ArrayValue::class;
    }
}