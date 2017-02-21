<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\ConfigurationInterface;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BaseValue;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm\FormField\OptionValue
 */
class ConfigValueFactory
{
    /**
     * @var ConfigValueFactoryInterface[]
     */
    private $factories = [];

    /**
     * @param ConfigValueFactoryInterface $factory
     */
    public function addFactory(ConfigValueFactoryInterface $factory)
    {
        $this->factories[$factory->supports()] = $factory;
    }

    /**
     * @param ConfigurationInterface $configuration
     *
     * @return BaseValue
     */
    public function create(ConfigurationInterface $configuration)
    {
        $valueClass = $configuration->getValueClass();

        if (true === array_key_exists($valueClass, $this->factories)) {
            return $this->factories[$valueClass]->create($configuration);
        }

        return $this->baseCreate($configuration);
    }

    /**
     * @param ConfigurationInterface $configuration
     *
     * @return BaseValue
     */
    private function baseCreate(ConfigurationInterface $configuration)
    {
        $valueClass = $configuration->getValueClass();
        $value = new $valueClass;

        if (null !== $configuration->getDefaultValue()) {
            $value->setContent($configuration->getDefaultValue());
        }

        return $value;
    }
}
