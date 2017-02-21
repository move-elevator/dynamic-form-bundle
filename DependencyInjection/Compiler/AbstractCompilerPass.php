<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @package DynamicFormBundle\DependencyInjection\Compiler
 */
abstract class AbstractCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    abstract public function process(ContainerBuilder $container);

    /**
     * @param ContainerBuilder $container
     * @param string           $registryService
     * @param string           $addMethod
     * @param string           $tagName
     */
    protected function addTaggedServiceToRegistry(ContainerBuilder $container, $registryService, $addMethod, $tagName)
    {
        $optionConfigurator = $container->findDefinition($registryService);
        $builder = $container->findTaggedServiceIds($tagName);

        foreach (array_keys($builder) as $id) {
            $optionConfigurator->addMethodCall($addMethod, [new Reference($id)]);
        }
    }
}