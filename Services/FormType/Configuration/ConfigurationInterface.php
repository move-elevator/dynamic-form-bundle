<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
interface ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getFormTypeClass();

    /**
     * @return string
     */
    public function getValueClass();

    /**
     * @return array
     */
    public function getAvailableOptions();
}