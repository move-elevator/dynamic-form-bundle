<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\Value\StringValue;
use DynamicFormBundle\Form\BaseType\RadioGroupType;
use DynamicFormBundle\Statics\FieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\FormTypes;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class RadioGroupTypeConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::RADIO_GROUP;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return RadioGroupType::class;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return StringValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return ChoiceOptions::all();
    }
}