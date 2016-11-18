<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormFieldOptionPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $configurationRegistry = $container->findDefinition('dynamic_form.admin.form_field.option.registry');
        $configurations = $container->findTaggedServiceIds('form_field.option_configuration');

        foreach (array_keys($configurations) as $id) {
            $configurationRegistry->addMethodCall('addConfiguration', [new Reference($id)]);
        }
    }
}
