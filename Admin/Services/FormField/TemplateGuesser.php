<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Admin\Services\TemplateGuesser as BaseGuesser;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package AppBundle\Service
 */
class TemplateGuesser extends BaseGuesser
{
    /**
     * @param FormField $formField
     * @param array     $parameter
     *
     * @return Response
     */
    public function render(FormField $formField, $parameter = [])
    {
        $templatePath = $this->getTemplatePath('form_field', $formField->getFormType());

        $parameter = array_merge($parameter, ['form_field' => $formField]);

        $response = new Response;
        $response->setContent($this->templateEngine->render($templatePath, $parameter));

        return $response;
    }
}
