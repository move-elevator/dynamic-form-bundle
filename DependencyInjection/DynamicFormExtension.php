<?php

namespace DynamicFormBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @package DynamicFormBundle\DependencyInjection
 */
class DynamicFormExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('dynamic_form.file_upload_dir', $config['file_upload_dir']);
        $container->setParameter('dynamic_form.form_field.disable_options', []);
        $container->setParameter('dynamic_form.form_field.disable_form_types', []);

        if (true === isset($config['form_field']['disable_options'])) {
            $container->setParameter(
                'dynamic_form.form_field.disable_options',
                $config['form_field']['disable_options']
            );
        }

        if (true === isset($config['form_field']['disable_form_types'])) {
            $container->setParameter(
                'dynamic_form.form_field.disable_form_types',
                $config['form_field']['disable_form_types']
            );
        }

        $locator = new FileLocator(__DIR__ . '/../Resources/config/');
        $loader  = new YamlFileLoader($container, $locator);

        $loader->load('services.yml');
        $loader->load('services_admin.yml');
    }
}