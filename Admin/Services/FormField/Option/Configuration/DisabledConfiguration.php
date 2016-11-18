<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option\Configuration;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\Value\BooleanValue;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option\Configuration
 */
class DisabledConfiguration implements ConfigurationInterface
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
        return BaseOptions::DISABLED;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return SymfonyFieldOptions::DISABLED;
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