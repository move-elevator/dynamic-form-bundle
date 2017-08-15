<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\StringValue;
use DynamicFormBundle\Services\FormType\ConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\FormTypes;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class TextTypeConfiguration implements ConfigurationInterface
{
    /**
     * @var array
     */
    private $globalOptions;

    /**
     * @param array $globalOptions
     */
    public function __construct(array $globalOptions)
    {
        $this->globalOptions = $globalOptions;
    }

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
        return array_merge(BaseOptions::all(), $this->globalOptions);
    }
}
