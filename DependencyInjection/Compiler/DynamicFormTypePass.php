<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormTypePass extends AbstractCompilerPass
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $this->addTaggedServiceToRegistry(
            $container,
            'dynamic_form.form_type.registry',
            'addConfiguration',
            'form.type_configuration'
        );
    }
}
