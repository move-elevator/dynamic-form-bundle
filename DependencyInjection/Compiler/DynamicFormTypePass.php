<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormTypePass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $configurationRegistry = $container->findDefinition('dynamic_form.type_configuration.registry');
        $configurations = $container->findTaggedServiceIds('form.type_configuration');

        foreach (array_keys($configurations) as $id) {
            $configurationRegistry->addMethodCall('addConfiguration', [new Reference($id)]);
        }
    }
}
