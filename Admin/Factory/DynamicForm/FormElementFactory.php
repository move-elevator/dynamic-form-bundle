<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use DynamicFormBundle\Admin\Services\FormElement\Configuration\Registry;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm
 */
class FormElementFactory
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param DynamicForm $form
     * @param string      $name
     *
     * @return FormElement
     */
    public function create(DynamicForm $form, $name)
    {
        $configuration = $this->registry->getConfiguration($name);

        $formElement = $configuration->getFormElement();
        $formElement = new $formElement;

        $value = $configuration->getValueClass();
        $formElement->setText($value);

        $form->addElement($formElement);

        return $formElement;
    }
}