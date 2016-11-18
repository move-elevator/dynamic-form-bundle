<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Entity\Value\BaseValue;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm\FormField
 */
class OptionValueFactory
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
     * @param string $option
     *
     * @return OptionValue
     */
    public function create($option)
    {
        $configuration = $this->registry->getConfiguration($option);
        $valueClass = $configuration->getValueClass();

        /** @var BaseValue $value */
        $value = new $valueClass;
        $value->setContent($configuration->getDefaultValue());

        return new OptionValue($configuration->getName(), $configuration->getOption(), $value);
    }
}