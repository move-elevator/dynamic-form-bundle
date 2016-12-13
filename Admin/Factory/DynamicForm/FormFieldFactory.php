<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm;

use DynamicFormBundle\Admin\Factory\DynamicForm\FormField\OptionValueFactory;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Services\FormType\Configuration\Registry;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm
 */
class FormFieldFactory extends SortableFactory
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
     * @param string      $formType
     *
     * @return FormField
     */
    public function create(DynamicForm $form, $formType)
    {
        $formField = new FormField();
        $formField->setFormType($formType);

        $position = $this->calculatePosition($form);
        $formField->setPosition(++$position);

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

        $config = $this->registry->getConfiguration($formField->getFormType());

        foreach ($config->getAvailableOptions() as $option) {
            if (true === $formField->hasOptionValues($option)) {
                continue;
            }

            $formField->addOptionValue($this->optionFactory->create($option));
        }
    }
}