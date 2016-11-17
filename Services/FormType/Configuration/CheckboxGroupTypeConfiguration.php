<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\Value\ArrayValue;
use DynamicFormBundle\Form\BaseType\CheckboxGroupType;
use DynamicFormBundle\Statics\FieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\FormTypes;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class CheckboxGroupTypeConfiguration implements ConfigurationInterface
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
        return ArrayValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return ChoiceOptions::all();
    }
}