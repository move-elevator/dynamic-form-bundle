<?php

namespace DynamicFormBundle\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BooleanValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;

/**
 * @package DynamicFormBundle\Services\FormField
 */
class OptionBuilder
{
    const ATTR_PREFIX = 'attr.';

    /**
     * @var OptionFilter
     */
    private $optionFilter;

    /**
     * @param OptionFilter $optionFilter
     */
    public function __construct(OptionFilter $optionFilter)
    {
        $this->optionFilter = $optionFilter;
    }

    /**
     * @param FormField $formField
     *
     * @return array
     */
    public function build(FormField $formField)
    {
        /** @var OptionValue[] $optionValues */
        $optionValues = $this->optionFilter->filterDisabledOptions($formField->getOptionValues());
        $options = [];

        foreach ($optionValues as $optionValue) {
            if (true === $this->isAttributeOption($optionValue)) {
                $this->addAttributeValue($optionValue, $options);
                continue;
            }

            $options[$optionValue->getOption()] = $optionValue->getRealValue();
        }

        return $options;
    }

    /**
     * @param OptionValue $optionValue
     *
     * @return boolean
     */
    private function isAttributeOption(OptionValue $optionValue)
    {
        return 0 === strpos($optionValue->getOption(), static::ATTR_PREFIX);
    }

    /**
     * @param OptionValue $optionValue
     * @param array       $options
     */
    private function addAttributeValue(OptionValue $optionValue, array &$options)
    {
        $option = str_replace(static::ATTR_PREFIX, '', $optionValue->getOption());
        $value = $optionValue->getValue();

        if (false === $value instanceof BooleanValue || $value->getContent() === true) {
            $options['attr'][$option] = $optionValue->getRealValue();
        }
    }
}