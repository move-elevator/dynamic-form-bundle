<?php

namespace DynamicFormBundle\Admin\Services\FormField\Option;

/**
 * @package DynamicFormBundle\Admin\Services\FormField\Option
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
    public function getName();

    /**
     * @return string
     */
    public function getOption();

    /**
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * @return string
     */
    public function getValueClass();
}