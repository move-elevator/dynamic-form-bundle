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
    private $configurations;

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

        return $this->configurations[$name];
    }
}