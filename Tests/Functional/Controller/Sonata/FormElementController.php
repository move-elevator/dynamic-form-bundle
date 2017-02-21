<?php

namespace DynamicFormBundle\Tests\Functional\Controller;

use DynamicFormBundle\Entity\DynamicForm\FormElement;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Tests\Utility\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Tests\Functional\Controller
 */
class FormElementControllerTest extends WebTestCase
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
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-element/headline/create');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateNewHeadline()
    {
        $text = uniqid();

        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-element/headline/create', [
            'form_element' => ['text' => $text]
        ]);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $headline = $this
            ->getEntityManager()
            ->getRepository(FormHeadline::class)
            ->findOneBy(['text' => $text]);

        $this->assertInstanceOf(FormHeadline::class, $headline);
    }

    public function testAccessEditAction()
    {
        $this->client->request(Request::METHOD_GET, '/admin/dynamic-form/form/1/form-element/1/edit');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testEditHeadlineText()
    {
        $text = uniqid();

        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-element/2/edit', [
            'form_element' => ['text' => $text]
        ]);

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $headline = $this
            ->getEntityManager()
            ->find(FormHeadline::class, 2);

        $this->assertEquals($text, $headline->getText());
    }

    public function testAccessDeleteAction()
    {
        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-element/1/delete');

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());

        $element = $this
            ->getEntityManager()
            ->find(FormElement::class, 1);

        $this->assertNull($element);
    }

    public function testAccessCloneAction()
    {
        $element = $this
            ->getEntityManager()
            ->find(FormElement::class, 1);

        $elements = $this
            ->getEntityManager()
            ->getRepository(FormElement::class)
            ->findBy(['text' => $element->getText()]);

        $this->assertCount(1, $elements);

        $this->client->request(Request::METHOD_POST, '/admin/dynamic-form/form/1/form-element/1/clone');

        $elements = $this
            ->getEntityManager()
            ->getRepository(FormElement::class)
            ->findBy(['text' => $element->getText()]);

        $this->assertCount(2, $elements);
        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    }
}