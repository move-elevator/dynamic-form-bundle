<?php

namespace DynamicFormBundle\Admin\Services\FormElement;

use DynamicFormBundle\Entity\DynamicForm\FormElement\FormText;
use DynamicFormBundle\Entity\Value\TextValue;
use DynamicFormBundle\Statics\FormElements;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @package DynamicFormBundle\Admin\Services\FormElement
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

    /**
     * @return string
     */
    public function getValueClass()
    {
        return TextValue::class;
    }
}