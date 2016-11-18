<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm;

use DynamicFormBundle\Admin\Factory\DynamicForm\FormField\OptionValueFactory;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\FormType;
use DynamicFormBundle\Model\SortableInterface;
use DynamicFormBundle\Services\FormType\Configuration\Registry;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm
 */
class FormFieldFactory
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var OptionValueFactory
     */
    private $optionFactory;

    /**
     * @param Registry           $registry
     * @param OptionValueFactory $optionFactory
     */
    public function __construct(Registry $registry, OptionValueFactory $optionFactory)
    {
        $this->registry = $registry;
        $this->optionFactory = $optionFactory;
    }

    /**
     * @param DynamicForm $form
     * @param FormType    $formType
     *
     * @return FormField
     */
    public function create(DynamicForm $form, FormType $formType)
    {
        $formField = new FormField();
        $formField->setFormType($formType);

        $position = $this->calculatePosition($form);
        $formField->setPosition(++$position);
        $form->addField($formField);

        $this->initOptions($formField);

        return $formField;
    }

    /**
     * @param FormField $formField
     */
    public function initOptions(FormField $formField)
    {
        if (null === $formField->getFormType()) {
            return;
        }

        $config = $this->registry->getConfiguration($formField->getFormType()->getName());

        foreach ($config->getAvailableOptions() as $option) {
            if (true === $formField->hasOptionValues($option)) {
                continue;
            }

            $formField->addOptionValue($this->optionFactory->create($option));
        }
    }

    /**
     * @param DynamicForm $form
     *
     * @return integer
     */
    private function calculatePosition(DynamicForm $form)
    {
        $position = 0;

        $sortableElements = array_merge(
            $form->getElements()->toArray(),
            $form->getFields()->toArray()
        );

        /** @var SortableInterface $sortable */
        foreach ($sortableElements as $sortable) {
            if ($position < $sortable->getPosition()) {
                $position = $sortable->getPosition();
            }
        }

        return ++$position;
    }
}