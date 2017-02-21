<?php

namespace DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder;

use DynamicFormBundle\Admin\Services\FormField\Option\ChoiceConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder
 */
class ChoiceFieldBuilder extends SingleFieldBuilder
{
    /**
     * @var ChoiceConfigurationInterface
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
        $form->add($optionValue->getName(), CollectionType::class, $this->getFormOptions());

        return $form;
    }

    /**
     * @return array
     */
    protected function getFormOptions()
    {
        return array_merge(parent::getFormOptions(), [
            'choices' => $this->configuration->getChoices()
        ]);
    }

    public function supports()
    {
        return ChoiceConfigurationInterface::class;
    }
}
