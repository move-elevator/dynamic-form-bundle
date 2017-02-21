<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option\Configuration;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\StringValue;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option\Configuration
 */
class LabelConfiguration implements ConfigurationInterface
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
        return BaseOptions::LABEL;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return SymfonyFieldOptions::LABEL;
    }

    /**
     * @return null
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
        return StringValue::class;
    }
}
