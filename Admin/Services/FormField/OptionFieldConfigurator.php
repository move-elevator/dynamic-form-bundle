<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\ChoiceConfigurationInterface;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Services\FormField\OptionFilter;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Admin\Services\FormField
 */
class OptionFieldConfigurator
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var OptionFilter
     */
    private $optionFilter;

    /**
     * @param Registry     $registry
     * @param OptionFilter $optionFilter
     */
    public function __construct(Registry $registry, OptionFilter $optionFilter)
    {
        $this->registry = $registry;
        $this->optionFilter = $optionFilter;
    }

    /**
     * @param FormInterface $form
     * @param FormField     $formField
     */
    public function configFields(FormInterface $form, FormField $formField)
    {
        /** @var FormField\OptionValue[] $optionValues */
        $optionValues = $this->optionFilter->filterDisabledOptions($formField->getOptionValues());

        foreach ($optionValues as $optionValue) {
            $configuration = $this->registry->getConfiguration($optionValue->getName());
            $form->add($optionValue->getName(), $configuration->getFormTypeClass(), $this->getFormOptions($configuration));
        }
    }

    /**
     * @param FormField       $formField
     * @param FormInterface[] $forms
     */
    public function mapToForms(FormField $formField, array $forms)
    {
        foreach ($formField->getOptionValues() as $option) {
            if (true === array_key_exists($option->getName(), $forms)) {
                $forms[$option->getName()]->setData($option->getRealValue());
            }
        }
    }

    /**
     * @param FormField       $formField
     * @param FormInterface[] $forms
     */
    public function mapToOptionValues(FormField $formField, array $forms)
    {
        foreach ($formField->getOptionValues() as $option) {
            if (true === array_key_exists($option->getName(), $forms)) {
                $data = $forms[$option->getName()]->getData();
                $option->setRealValue($data);
            }
        }
    }

    /**
     * @param ConfigurationInterface $configuration
     *
     * @return array
     */
    private function getFormOptions(ConfigurationInterface $configuration)
    {
        $options = [
            'mapped' => false,
            'required' => false
        ];

        if ($configuration instanceof ChoiceConfigurationInterface) {
            $options['choices'] = $configuration->getChoices();
        }

        return $options;
    }
}