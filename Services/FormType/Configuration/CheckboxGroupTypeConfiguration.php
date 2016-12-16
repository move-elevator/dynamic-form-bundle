<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\ChoicesValue;
use DynamicFormBundle\Form\BaseType\CheckboxGroupType;
use DynamicFormBundle\Statics\FormFieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\FormTypes;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class CheckboxGroupTypeConfiguration extends AbstractChoiceConfiguration
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::CHECKBOX_GROUP;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return CheckboxGroupType::class;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return ChoicesValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return ChoiceOptions::all();
    }
}