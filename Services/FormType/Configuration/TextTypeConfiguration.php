<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\Value\StringValue;
use DynamicFormBundle\Statics\FieldOptions\BaseOptions;
use DynamicFormBundle\Statics\FormTypes;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class TextTypeConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::TEXT;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return TextType::class;
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
        return BaseOptions::all();
    }
}