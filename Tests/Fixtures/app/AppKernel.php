<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @package DynamicFormBundle\Tests\Fixtures\app
 */
class AppKernel extends Kernel
{
    /**
     * @return array
     */
    public function registerBundles()
    {
        return [
            new DynamicFormBundle\DynamicFormBundle,
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new Symfony\Bundle\TwigBundle\TwigBundle,
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle,
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle,
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle,
            new Hautelook\AliceBundle\HautelookAliceBundle
        ];
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return sprintf('%s/cache/%s', $this->rootDir, $this->environment);
    }

    /**
     * @param LoaderInterface $loader
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }
}
