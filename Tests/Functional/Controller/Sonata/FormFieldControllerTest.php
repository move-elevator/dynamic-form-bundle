<?php

namespace DynamicFormBundle\Tests\Functional\Controller;

use DynamicFormBundle\Entity\DynamicForm\FormField;
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

    public function testCreateNewFormField()
    {
        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-field/text/create', [
            'form_field' => [
                'name' => 'TestField',
                'required' => true
            ]
        ]);

        $field = $this->getEntityManager()->getRepository(FormField::class)->findOneBy(['name' => 'TestField']);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $this->assertInstanceOf(FormField::class, $field);
        $this->assertTrue($field->getOptionValue('required')->getRealValue());
    }

    public function testAccessEditAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-field/1/edit');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testEditFormField()
    {
        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-field/1/edit', [
            'form_field' => [
                'name' => 'New Name',
                'required' => true
            ]
        ]);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $field = $this->getEntityManager()->find(FormField::class, 1);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('New Name', $field->getName());
        $this->assertTrue($field->getOptionValue('required')->getRealValue());
    }

    public function testAccessDeleteAction()
    {
        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-field/1/delete');

        $field = $this->getEntityManager()->find(FormField::class, 1);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->assertNull($field);
    }

    public function testAccessCloneAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-field/1/clone');

        $fields = $this->getEntityManager()->getRepository(FormField::class)->findBy(['name' => 'name']);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->assertCount(2, $fields);
    }
}
