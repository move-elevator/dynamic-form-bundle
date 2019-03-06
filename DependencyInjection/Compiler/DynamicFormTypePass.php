<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use DynamicFormBundle\Services\FormType\Configuration\Registry;
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
            Registry::class,
            'addConfiguration',
            'form.type_configuration'
        );
    }
}
