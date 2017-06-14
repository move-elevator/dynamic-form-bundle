<?php

namespace DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder;

use DynamicFormBundle\Admin\Services\FormField\Option\CollectionConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder
 */
class CollectionFieldBuilder extends SingleFieldBuilder
{
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
     * @return string
     */
    public function supports()
    {
        return CollectionConfigurationInterface::class;
    }

    /**
     * @return array
     */
    protected function getFormOptions()
    {
        return array_merge(parent::getFormOptions(), [
            'entry_type' => $this->configuration->getFormTypeClass(),
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'allow_delete' => true,
            'required' => true
        ]);
    }
}
