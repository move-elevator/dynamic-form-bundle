<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option\Configuration;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BooleanValue;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option\Configuration
 */
class RequiredConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return CheckboxType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return BaseOptions::REQUIRED;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return SymfonyFieldOptions::REQUIRED;
    }

    /**
     * @return boolean
     */
    public function getDefaultValue()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return BooleanValue::class;
    }
}
