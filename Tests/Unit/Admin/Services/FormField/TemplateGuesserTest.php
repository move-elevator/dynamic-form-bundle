<?php

namespace DynamicFormBundle\Tests\Unit\Admin\Services\FormField;

use DynamicFormBundle\Admin\Services\FormField\TemplateGuesser;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Tests\Utility\TemplateGuesserTestCase;

/**
 * @package DynamicFormBundle\Tests\Unit\Admin\Services\FormField
 */
class TemplateGuesserTest extends TemplateGuesserTestCase
{
    public function testRenderFallbackTemplateIfNoSpecificTemplateExist()
    {
        $formField = new FormField();

        $engine = $this->getTwigEnvironmentMock(
            '@DynamicForm/sonata-admin/form/form_field.html.twig',
            ['formField' => $formField],
            false
        );

        $templateGuesser = new TemplateGuesser($engine);
        $templateGuesser->render($formField);
    }

    public function testRenderSpecificTemplateeIfExist()
    {
        $formField = new FormField();
        $formField->setFormType('text');

        $engine = $this->getTwigEnvironmentMock(
            '@DynamicForm/sonata-admin/form/form_field/text.html.twig',
            ['formField' => $formField],
            true
        );

        $templateGuesser = new TemplateGuesser($engine);
        $templateGuesser->render($formField);
    }

    public function testRenderAdditionalParams()
    {
        $formField = new FormField();
        $formField->setFormType('text');

        $engine = $this->getTwigEnvironmentMock(
            '@DynamicForm/sonata-admin/form/form_field/text.html.twig',
            ['formField' => $formField, 'param' => 'render'],
            true
        );

        $templateGuesser = new TemplateGuesser($engine);
        $templateGuesser->render($formField, ['param' => 'render']);
    }
}
