<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder\BuilderInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
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
     * @var BuilderInterface[]
     */
    private $optionFieldBuilder = [];

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
            $configuration = $this
                ->registry
                ->getConfiguration($optionValue->getName());

            $this
                ->getOptionFieldBuilder($configuration)
                ->buildOptionField($form, $optionValue);
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

    /**
     * @param BuilderInterface $builder
     */
    public function addOptionFieldBuilder(BuilderInterface $builder)
    {
        $this->optionFieldBuilder[$builder->supports()] = $builder;
    }

    /**
     * @param ConfigurationInterface $configuration
     *
     * @return BuilderInterface
     */
    private function getOptionFieldBuilder(ConfigurationInterface $configuration)
    {
        $interfaces = class_implements($configuration);

        foreach ($interfaces as $interface) {
            if (true === array_key_exists($interface, $this->optionFieldBuilder)) {
                return $this->optionFieldBuilder[$interface]->setConfiguration($configuration);
            }
        }

        throw new \LogicException(sprintf('No Builder for %s exists', get_class($configuration)));
    }
}
