<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BaseValue;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm\FormField
 */
interface ConfigValueFactoryInterface
{
    /**
     * @param ConfigurationInterface $configuration
     *
     * @return BaseValue
     */
    public function create(ConfigurationInterface $configuration);

    /**
     * @return string
     */
    public function supports();
}