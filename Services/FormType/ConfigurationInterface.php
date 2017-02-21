<?php

namespace DynamicFormBundle\Services\FormType;

/**
 * @package DynamicFormBundle\Services\FormType
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
