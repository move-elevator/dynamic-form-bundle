<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\ChoiceConfigurationInterface;
use DynamicFormBundle\Admin\Services\FormField\Option\CollectionConfigurationInterface;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Services\FormField\OptionFilter;
use Sonata\AdminBundle\Form\Type\CollectionType;
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
        /** @var OptionValue[] $optionValues */
        $optionValues = $this->optionFilter->filterDisabledOptions($formField->getOptionValues());

        foreach ($optionValues as $optionValue) {
            $configuration = $this->registry->getConfiguration($optionValue->getName());
            $this->addOptionField($form, $optionValue, $configuration);
        }
    }
    /**
     * @param FormField       $formField
     * @param FormInterface[] $forms
     */
    public function mapToForms(FormField $formField, array $forms)
    {
        /** @var OptionValue[] $optionValues */
        $optionValues = $this->optionFilter->filterDisabledOptions($formField->getOptionValues());

        foreach ($optionValues as $option) {
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
        /** @var OptionValue[] $optionValues */
        $optionValues = $this->optionFilter->filterDisabledOptions($formField->getOptionValues());

        foreach ($optionValues as $option) {
            if (true === array_key_exists($option->getName(), $forms)) {
                $data = $forms[$option->getName()]->getData();
                $option->setRealValue($data);
            }
        }
    }

    private function addOptionField(FormInterface $form, OptionValue $optionValue, ConfigurationInterface $configuration)
    {
        $formType = $configuration->getFormTypeClass();

        if ($configuration instanceof CollectionConfigurationInterface) {
            $formType = CollectionType::class;
        }

        $form->add($optionValue->getName(), $formType, $this->getFormOptions($configuration));
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

        if ($configuration instanceof CollectionConfigurationInterface) {
            $options = array_merge($options, [
                'entry_type' => $configuration->getFormTypeClass(),
                'allow_add' => true,
                'allow_delete' => true,
                'options' => ['label' => false]
            ]);
        }

        if ($configuration instanceof ChoiceConfigurationInterface) {
            $options['choices'] = $configuration->getChoices();
        }

        return $options;
    }
}