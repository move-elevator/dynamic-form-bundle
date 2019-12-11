<?php

namespace DynamicFormBundle\Tests\Unit\Admin\Services\FormElement;

use DynamicFormBundle\Admin\Services\FormElement\TemplateGuesser;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormText;
use DynamicFormBundle\Tests\Utility\TemplateGuesserTestCase;

/**
 * @package DynamicFormBundle\Tests\Unit\Admin\Services\FormElement
 */
class TemplateGuesserTest extends TemplateGuesserTestCase
{
    public function testRenderFallbackTemplateIfNoSpecificTemplateExist()
    {
        $formHeadline = new FormHeadline();

        $engine = $this->getTwigEnvironmentMock(
            '@DynamicForm/sonata-admin/form/form_element.html.twig',
            ['formElement' => $formHeadline],
            false
        );

        $templateGuesser = new TemplateGuesser($engine);
        $templateGuesser->render($formHeadline);
    }

    public function testRenderSpecificTemplateeIfExist()
    {
        $formText = new FormText();

        $engine = $this->getTwigEnvironmentMock(
            '@DynamicForm/sonata-admin/form/form_element/text.html.twig',
            ['formElement' => $formText],
            true
        );

        $templateGuesser = new TemplateGuesser($engine);
        $templateGuesser->render($formText);
    }

    public function testRenderAdditionalParams()
    {
        $formElement = new FormHeadline();

        $engine = $this->getTwigEnvironmentMock(
            '@DynamicForm/sonata-admin/form/form_element/headline.html.twig',
            ['formElement' => $formElement, 'param' => 'render'],
            true
        );

        $templateGuesser = new TemplateGuesser($engine);
        $templateGuesser->render($formElement, ['param' => 'render']);
    }
}
