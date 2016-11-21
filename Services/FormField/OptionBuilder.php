<?php

namespace DynamicFormBundle\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Entity\Value\BooleanValue;

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
        $options = [];

        foreach ($formField->getOptionValues() as $optionValue) {
            if (true === $this->isAttributeOption($optionValue)) {
                $this->addAttributeValue($optionValue, $options);
                continue;
            }

            $options[$optionValue->getOption()] = $optionValue->getRealValue();
        }

        $this->optionFilter->removeDisabledOptions($options);

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

    private function addAttributeValue(OptionValue $optionValue, &$options)
    {
        $option = str_replace(static::ATTR_PREFIX, '', $optionValue->getOption());
        $value = $optionValue->getValue();

        if (false === $value instanceof BooleanValue || $value->getContent() === true) {
            $options['attr'][$option] = $optionValue->getRealValue();
        }
    }
}