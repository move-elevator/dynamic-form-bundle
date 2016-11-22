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
                ->arrayNode('form_field')
                    ->children()
                        ->arrayNode('disable_options')
                            ->prototype('scalar')
                            ->end()
                        ->end()
                        ->arrayNode('disable_form_types')
                            ->prototype('scalar')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
