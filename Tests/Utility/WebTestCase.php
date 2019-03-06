<?php

namespace DynamicFormBundle\Tests\Utility;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @package DynamicFormBundle\Tests\Utility
 */
class WebTestCase extends BaseTestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = self::createClient();
    }

    /**
     * @param array $fixtureFiles
     */
    protected function loadAliceFixtures(array $fixtureFiles)
    {
        $fixtures = $this->client
            ->getContainer()
            ->get('nelmio_alice.files_loader')->loadFiles($fixtureFiles);

        foreach ($fixtures->getObjects() as $object) {
            $this->getEntityManager()->persist($object);
        }

        $this->getEntityManager()->flush();

        $this
            ->getEntityManager()
            ->clear();
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->client->getContainer();
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->client
            ->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function createDatabase()
    {
        $this->runCommand('doctrine:schema:create');
    }

    protected function runCommand($command)
    {
        $kernel = $this
            ->getContainer()
            ->get('kernel');

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(['command' => $command]);
        $output = new BufferedOutput();

        $application->run($input, $output);
    }

    /**
     * @param $fixtureFile
     *
     * @return string
     */
    protected function getAliceFixturePath($fixtureFile)
    {
        return sprintf(
            '%s/../../DataFixtures/ORM/%s',
            $this->getContainer()->get('kernel')->getRootDir(),
            $fixtureFile
        );
    }
}
