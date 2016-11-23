<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\StringValue;
use DynamicFormBundle\Form\BaseType\SelectType;
use DynamicFormBundle\Services\FormType\ConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\ChoiceOptions;
use DynamicFormBundle\Statics\FormTypes;


/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class SelectTypeConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::SELECT;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return SelectType::class;
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