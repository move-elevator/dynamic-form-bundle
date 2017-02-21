<?php

namespace DynamicFormBundle\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BooleanValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Services\FormType\ChoiceConfigurationInterface;
use DynamicFormBundle\Services\FormType\ConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;

/**
 * @package DynamicFormBundle\Services\FormField
 */
class OptionBuilder
{
    const ATTR_PREFIX = 'attr';

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
     * @param FormField              $formField
     * @param ConfigurationInterface $configuration
     *
     * @return array
     */
    public function  build(FormField $formField, ConfigurationInterface $configuration)
    {
        /** @var OptionValue[] $optionValues */
        $optionValues = $this->optionFilter->filterDisabledOptions($formField->getOptionValues());
        $options = $this->getConfigOptions($configuration);

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
     * @param ConfigurationInterface $configuration
     *
     * @return array
     */
    private function getConfigOptions(ConfigurationInterface $configuration)
    {
        $options = [];

        if ($configuration instanceof ChoiceConfigurationInterface) {
            $options = [
                'choice_label' => $configuration->getChoiceLabelFunction(),
                'choice_value' => $configuration->getChoiceValueFunction()
            ];
        }

        if (false === in_array(BaseOptions::LABEL, $configuration->getAvailableOptions())) {
            $options[BaseOptions::LABEL] = false;
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
        $option = ltrim(str_replace(static::ATTR_PREFIX, '', $optionValue->getOption()), '.');
        $value = $optionValue->getValue();

        if (false === $value instanceof BooleanValue || $value->getContent() === true) {
            $options[self::ATTR_PREFIX][$option] = $optionValue->getRealValue();
        }
    }
}