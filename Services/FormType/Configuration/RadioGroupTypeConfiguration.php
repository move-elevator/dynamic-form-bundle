<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\ChoiceValue;
use DynamicFormBundle\Form\BaseType\RadioGroupType;
use DynamicFormBundle\Statics\FormFieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\FormTypes;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class RadioGroupTypeConfiguration extends AbstractChoiceConfiguration
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
        return ChoiceValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return ChoiceOptions::all();
    }
}