<?php

namespace DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder
 */
class SingleFieldBuilder implements BuilderInterface
{
    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * @param FormInterface $form
     * @param OptionValue   $optionValue
     *
     * @return FormInterface
     */
    public function buildOptionField(FormInterface $form, OptionValue $optionValue)
    {
        $form->add(
            $optionValue->getName(),
            $this->configuration->getFormTypeClass(),
            $this->getFormOptions()
        );

        return $form;
    }

    /**
     * @return string
     */
    public function supports()
    {
        return ConfigurationInterface::class;
    }

    /**
     * @param ConfigurationInterface $configuration
     *
     * @return BuilderInterface
     */
    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * @return array
     */
    protected function getFormOptions()
    {
        return [
            'mapped' => false,
            'required' => false
        ];
    }
}
