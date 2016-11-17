<?php

namespace DynamicFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @package DynamicFormBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dynamic_form');

        $rootNode
            ->children()
                ->scalarNode('file_upload_dir')
                    ->isRequired()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
