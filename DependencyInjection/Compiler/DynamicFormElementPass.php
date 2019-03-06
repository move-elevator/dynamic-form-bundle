<?php

namespace DynamicFormBundle\DependencyInjection\Compiler;

use DynamicFormBundle\Admin\Services\FormElement\Configuration\Registry;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @package AppBundle\DependencyInjection\Compiler
 */
class DynamicFormElementPass extends AbstractCompilerPass
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
            'form_element.configuration'
        );
    }
}
