<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use DynamicFormBundle\Admin\Factory\DynamicForm\FormField\ConfigValueFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormConfigValueFactoryPass extends AbstractCompilerPass
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $this->addTaggedServiceToRegistry(
            $container,
            ConfigValueFactory::class,
            'addFactory',
            'config_value.factory'
        );
    }
}
