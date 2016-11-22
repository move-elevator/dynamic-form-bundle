<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Services\FormType\ConfigurationInterface;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class Registry
{
    /**
     * @var ConfigurationInterface[]
     */
    private $configurations = [];

    /**
     * @var array
     */
    private $disabledTypes;

    /**
     * @param array $disabledTypes
     */
    public function __construct(array $disabledTypes = [])
    {
        $this->disabledTypes = $disabledTypes;
    }

    /**
     * @param ConfigurationInterface $configuration
     */
    public function addConfiguration(ConfigurationInterface $configuration)
    {
        $this->configurations[$configuration->getName()] = $configuration;
    }

    /**
     * @param string $name
     *
     * @return ConfigurationInterface
     */
    public function getConfiguration($name)
    {
        if (false === isset($this->configurations[$name])) {
            throw new \LogicException(sprintf('No Configuration found for %s', $name));
        }

        if (true === in_array($name, $this->disabledTypes)) {
            throw new \LogicException(sprintf('FormType %s is not available', $name));
        }

        return $this->configurations[$name];
    }

    /**
     * @return array
     */
    public function getAvailableTypes()
    {
        return array_diff(array_keys($this->configurations), $this->disabledTypes);
    }
}