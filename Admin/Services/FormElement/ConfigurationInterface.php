<?php

namespace DynamicFormBundle\Admin\Services\FormElement;

/**
 * @package DynamicFormBundle\Admin\Services\FormElement
 */
interface ConfigurationInterface
{
    /**
     * @return string
     */
    public function getFormTypeClass();

    /**
     * @return string
     */
    public function getFormElement();

    /**
     * @return string
     */
    public function getName();
}
