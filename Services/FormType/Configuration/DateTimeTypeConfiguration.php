<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\DateTimeValue;
use DynamicFormBundle\Services\FormType\ConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\DateTimeOptions;
use DynamicFormBundle\Statics\FormTypes;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class DateTimeTypeConfiguration implements ConfigurationInterface
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
        return FormTypes::DATETIME;
    }

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
    public function getValueClass()
    {
        return DateTimeValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return array_merge(DateTimeOptions::all(), $this->globalOptions);
    }
}
