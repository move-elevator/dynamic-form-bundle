<?php

namespace DynamicFormBundle\Admin\Services\FormElement;

use DynamicFormBundle\Admin\Services\TemplateGuesser as BaseGuesser;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package AppBundle\Service
 */
class TemplateGuesser extends BaseGuesser
{
    /**
     * @param FormElement $formElement
     * @param array       $parameter
     *
     * @return Response
     */
    public function render(FormElement $formElement, $parameter = [])
    {
        $templatePath = $this->getTemplatePath('form_element', $formElement->getElementType());

        $parameter = array_merge($parameter, ['form_element' => $formElement]);

        $response = new Response;
        $response->setContent($this->templateEngine->render($templatePath, $parameter));

        return $response;
    }
}
