<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\FormField;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * @package AppBundle\Service
 */
class FormFieldTemplateGuesser
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
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
        $response->setContent($this->twig->render($templatePath, $parameter));

        return $response;
    }

    /**
     * @throws \LogicException
     */
    private function getTemplatePath(FormField $formField)
    {
        $path = sprintf('@DynamicForm/sonata-admin/form/form_field/%s.html.twig', $formField->getFormType());

        if (true === $this->twig->getLoader()->exists($path)) {
            return $path;
        }

        return '@DynamicForm/sonata-admin/form/form_field.html.twig';
    }
}
