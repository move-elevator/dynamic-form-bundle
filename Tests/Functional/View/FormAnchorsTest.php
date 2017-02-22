<?php

namespace DynamicFormBundle\Tests\Functional\View;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Form\Type\DynamicFormType;
use DynamicFormBundle\Tests\Utility\WebTestCase;

/**
 * @package DynamicFormBundle\Tests\Functional\View
 */
class FormAnchorsTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->createDatabase();

        $this->loadAliceFixtures([
            $this->getAliceFixturePath('Test/dynamic_form.yml')
        ]);
    }

    public function testRenderDynamicFormElements()
    {
        $content = $this->createFormTemplate();

        // render FormHeadlines as Anchors
        $this->assertContains('<li><a href="#form_headline_2">Headline</a></li>', $content);
        $this->assertContains('<li><a href="#form_headline_3">Gender</a></li>', $content);
    }
    /**
     * @return string
     */
    private function createFormTemplate()
    {
        $dynamicForm = $this->getEntityManager()->find(DynamicForm::class, 1);

        $form = $this
            ->getContainer()
            ->get('form.factory')
            ->create(DynamicFormType::class, null, ['dynamic_form' => $dynamicForm])
            ->createView();

        return $this
            ->getContainer()
            ->get('twig')
            ->createTemplate('{{ form_anchors(form) }}')
            ->render(['form' => $form]);
    }
}
