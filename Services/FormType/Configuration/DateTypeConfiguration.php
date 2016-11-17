<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\Value\DateTimeValue;
use DynamicFormBundle\Statics\FieldOptions\DateTimeOptions;
use DynamicFormBundle\Statics\FormTypes;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class DateTypeConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::DATE;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return DateType::class;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return DateTimeValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return DateTimeOptions::all();
    }
}