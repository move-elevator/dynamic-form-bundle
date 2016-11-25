<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\ChoiceValue;
use DynamicFormBundle\Form\BaseType\SelectType;
use DynamicFormBundle\Statics\FormTypes;


/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class SelectTypeConfiguration extends AbstractChoiceConfiguration
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
        return ChoiceValue::class;
    }
}