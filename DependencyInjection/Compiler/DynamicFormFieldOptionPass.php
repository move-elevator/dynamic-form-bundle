<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

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
        $this->addTaggedServiceToRegistry($container, 'dynamic_form.admin.form_field.option.registry', 'addConfiguration', 'form_field.option_configuration');
        $this->addTaggedServiceToRegistry($container, 'dynamic_form.admin.form_field.option_field_configurator', 'addOptionFieldBuilder', 'form_field.option_field_builder');
    }
}
