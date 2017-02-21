<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;

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
     * @var ConfigValueFactory
     */
    private $valueFactory;

    /**
     * @param Registry           $registry
     * @param ConfigValueFactory $valueFactory
     */
    public function __construct(Registry $registry, ConfigValueFactory $valueFactory)
    {
        $this->registry = $registry;
        $this->valueFactory = $valueFactory;
    }

    /**
     * @param string $option
     *
     * @return OptionValue
     */
    public function create($option)
    {
        $configuration = $this->registry->getConfiguration($option);

        $value = $this->valueFactory->create($configuration);

        return new OptionValue($configuration->getName(), $configuration->getOption(), $value);
    }
}
