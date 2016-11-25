<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormConfigValueFactoryPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $configValueFactory = $container->findDefinition('dynamic_form.config_value.factory');
        $configurations = $container->findTaggedServiceIds('config_value.factory');

        foreach (array_keys($configurations) as $id) {
            $configValueFactory->addMethodCall('addFactory', [new Reference($id)]);
        }
    }
}
