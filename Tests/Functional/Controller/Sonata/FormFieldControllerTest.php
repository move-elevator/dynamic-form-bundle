<?php

namespace DynamicFormBundle\Tests\Functional\Controller;

use DynamicFormBundle\Tests\Utility\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Tests\Functional\Controller
 */
class FormFieldControllerTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->createDatabase();

        $this->loadAliceFixtures([
            $this->getAliceFixturePath('Test/dynamic_form.yml')
        ]);
    }

    public function testAccessCreateAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-field/text/create');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testAccessEditAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-field/1/edit');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testAccessDeleteAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-field/1/delete');

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function testAccessCloneAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-field/1/clone');

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    }
}
