<?php

namespace DynamicFormBundle\Tests;

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
            new \DynamicFormBundle\DynamicFormBundle,
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle,
            new \Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle,
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle,
            new \Hautelook\AliceBundle\HautelookAliceBundle,
            new \Fidry\AliceDataFixtures\Bridge\Symfony\FidryAliceDataFixturesBundle,
            new \Nelmio\Alice\Bridge\Symfony\NelmioAliceBundle,
            new \Sonata\CoreBundle\SonataCoreBundle,
            new \Sonata\BlockBundle\SonataBlockBundle,
            new \Sonata\AdminBundle\SonataAdminBundle,
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle,
            new \Symfony\Bundle\SecurityBundle\SecurityBundle,
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new \Symfony\Bundle\TwigBundle\TwigBundle,
            new \Knp\Bundle\MenuBundle\KnpMenuBundle()
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
        $loader->load(__DIR__.'/app/config/config.yml');
    }
}
