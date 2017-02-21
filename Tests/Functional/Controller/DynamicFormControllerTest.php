<?php

namespace DynamicFormBundle\Tests\Functional\Controller;

use DynamicFormBundle\Tests\Utility\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Tests\Functional\Controller
 */
class DynamicFormControllerTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->createDatabase();
    }

    public function testAccessCreateAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/create');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testAccessEditAction()
    {
        $this->loadAliceFixtures([
            $this->getAliceFixturePath('Test/dynamic_form.yml')
        ]);

        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/edit');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}