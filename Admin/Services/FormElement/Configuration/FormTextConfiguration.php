<?php

namespace DynamicFormBundle\Admin\Services\FormElement\Configuration;

use DynamicFormBundle\Admin\Services\FormElement\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormText;
use DynamicFormBundle\Statics\FormElements;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @package DynamicFormBundle\Admin\Services\FormElement\Configuration
 */
class FormTextConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return TextareaType::class;
    }

    /**
     * @return string
     */
    public function getFormElement()
    {
        return FormText::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return FormElements::TEXT;
    }
}