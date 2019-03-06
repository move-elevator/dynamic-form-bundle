<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormFieldOptionPass extends AbstractCompilerPass
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $this->addTaggedServiceToRegistry(
            $container,
            Registry::class,
            'addConfiguration',
            'form_field.option_configuration'
        );

        $this->addTaggedServiceToRegistry(
            $container,
            OptionFieldConfigurator::class,
            'addOptionFieldBuilder',
            'form_field.option_field_builder'
        );
    }
}
