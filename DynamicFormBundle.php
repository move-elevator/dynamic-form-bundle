<?php

namespace DynamicFormBundle;

use DynamicFormBundle\DependencyInjection\Compiler\DynamicFormFieldOptionPass;
use DynamicFormBundle\DependencyInjection\Compiler\DynamicFormTypePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @package DynamicFormBundle
 */
class DynamicFormBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DynamicFormTypePass());
        $container->addCompilerPass(new DynamicFormFieldOptionPass());
    }
}
