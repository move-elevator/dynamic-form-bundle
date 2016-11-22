<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\FormField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

/**
 * @package AppBundle\Service
 */
class FormFieldTemplateGuesser
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * @param EngineInterface $templateEngine
     */
    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param FormField $formField
     * @param array     $parameter
     *
     * @return Response
     */
    public function render(FormField $formField, $parameter = [])
    {
        $templatePath = $this->getTemplatePath($formField);

        $parameter = array_merge($parameter, ['form_field' => $formField]);

        $response = new Response;
        $response->setContent($this->templateEngine->render($templatePath, $parameter));

        return $response;
    }

    /**
     * @param FormField $formField
     * 
     * @return string
     *
     * @throws \LogicException
     */
    private function getTemplatePath(FormField $formField)
    {
        $path = sprintf('@DynamicForm/sonata-admin/form/form_field/%s.html.twig', $formField->getFormType());

        if (true === $this->templateEngine->exists($path)) {
            return $path;
        }

        return '@DynamicForm/sonata-admin/form/form_field.html.twig';
    }
}
