<?php

namespace DynamicFormBundle\Admin\Controller\Sonata\DynamicForm;

use DynamicFormBundle\Admin\Form\Type\DynamicForm\FormElementType;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Admin\Controller\Sonata\DynamicForm
 *
 * @Route("form/{formId}/form-element")
 */
class FormElementController extends Controller
{
    /**
     * @param Request     $request
     * @param string      $formElementType
     * @param DynamicForm $dynamicForm
     *
     * @Route("/{formElementType}/create")
     *
     * @ParamConverter("dynamicForm", class="DynamicFormBundle:DynamicForm", options={"mapping": {"formId": "id"}})
     *
     * @return Response
     */
    public function createAction(Request $request, $formElementType, DynamicForm $dynamicForm)
    {
        $formElement = $this
            ->get('dynamic_form.admin.form_element.factory')
            ->create($dynamicForm, $formElementType);

        $form = $this->createForm(FormElementType::class, $formElement);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $this
                ->getDoctrine()
                ->getManager()
                ->flush($dynamicForm);
        }

        return $this->get('dynamic_form.admin.form_element.template_guesser')->render($formElement, [
            'form' => $form->createView(),
            'dynamicForm' => $dynamicForm,
            'admin_pool' => $this->container->get('sonata.admin.pool')
        ]);
    }

    /**
     * @param Request     $request
     * @param DynamicForm $dynamicForm
     * @param FormElement $formElement
     *
     * @Route("/{elementId}/edit")
     *
     * @ParamConverter("formElement", class="DynamicFormBundle:DynamicForm\FormElement", options={"mapping": {"elementId": "id"}})
     * @ParamConverter("dynamicForm", class="DynamicFormBundle:DynamicForm", options={"mapping": {"formId": "id"}})
     *
     * @return Response
     */
    public function editAction(Request $request, DynamicForm $dynamicForm, FormElement $formElement)
    {
        $form = $this->createForm(FormElementType::class, $formElement);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $this
                ->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('dynamicform_admin_sonata_dynamicform_edit', ['id' => $dynamicForm->getId()]);
        }

        return $this->get('dynamic_form.admin.form_element.template_guesser')->render($formElement, [
            'form' => $form->createView(),
            'dynamicForm' => $dynamicForm,
            'admin_pool' => $this->container->get('sonata.admin.pool')
        ]);
    }
}