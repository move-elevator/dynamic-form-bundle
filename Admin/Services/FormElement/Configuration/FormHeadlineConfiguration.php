<?php

namespace DynamicFormBundle\Admin\Services\FormElement\Configuration;

use DynamicFormBundle\Admin\Services\FormElement\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Statics\FormElements;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Admin\Services\FormElement\Configuration
 */
class FormHeadlineConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return TextType::class;
    }

    /**
     * @return string
     */
    public function getFormElement()
    {
        return FormHeadline::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return FormElements::HEADLINE;
    }
}
