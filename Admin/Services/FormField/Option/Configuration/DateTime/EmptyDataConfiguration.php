<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option\Configuration\DateTime;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\DateTimeValue;
use DynamicFormBundle\Statics\FormFieldOptions\DateTimeOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option\Configuration
 */
class EmptyDataConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return DateTimeType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return DateTimeOptions::EMPTY_DATA;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return SymfonyFieldOptions::EMPTY_DATA;
    }

    /**
     * @return \DateTime
     */
    public function getDefaultValue()
    {
        return new \DateTime;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return DateTimeValue::class;
    }
}
