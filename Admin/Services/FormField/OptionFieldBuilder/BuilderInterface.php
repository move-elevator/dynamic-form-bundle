<?php

namespace DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder
 */
interface BuilderInterface
{
    /**
     * @param FormInterface $form
     * @param OptionValue   $optionValue
     *
     * @return FormInterface
     */
    public function buildOptionField(FormInterface $form, OptionValue $optionValue);

    /**
     * @param ConfigurationInterface $configuration
     *
     * @return BuilderInterface
     */
    public function setConfiguration(ConfigurationInterface $configuration);

    /**
     * @return string
     */
    public function supports();
}