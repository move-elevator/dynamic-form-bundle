<?php

namespace DynamicFormBundle\Admin\Controller\DynamicForm;

use DynamicFormBundle\Admin\Form\Type\DynamicForm\FormFieldType;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\FormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Admin\Controller\DynamicForm
 *
 * @Route("form/{formId}/form-field")
 */
class FormFieldController extends Controller
{
    /**
     * @param Request     $request
     * @param FormType    $formType
     * @param DynamicForm $dynamicForm
     *
     * @Route("/{formType}/create")
     *
     * @ParamConverter("formType", class="DynamicFormBundle:DynamicForm\FormField\FormType", options={"mapping": {"formType": "name"}})
     * @ParamConverter("dynamicForm", class="DynamicFormBundle:DynamicForm", options={"mapping": {"formId": "id"}})
     *
     * @return Response
     */
    public function createAction(Request $request, FormType $formType, DynamicForm $dynamicForm)
    {
        $formField = $this
            ->get('dynamic_form.admin.form_field.factory')
            ->create($dynamicForm, $formType);

        $form = $this->createForm(FormFieldType::class, $formField);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $this
                ->getDoctrine()
                ->getEntityManager()
                ->flush($dynamicForm);
        }

        return $this->render('@DynamicForm/admin/form/form_field_form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Request   $request
     * @param FormField $formField
     *
     * @Route("/{fieldId}/edit")
     *
     * @ParamConverter("formField", class="DynamicFormBundle:DynamicForm\FormField", options={"mapping": {"fieldId": "id"}})
     *
     * @return Response
     */
    public function editAction(Request $request, FormField $formField)
    {

        $this
            ->get('dynamic_form.admin.form_field.factory')
            ->initOptions($formField);

        $form = $this->createForm(FormFieldType::class, $formField);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $this
                ->getDoctrine()
                ->getEntityManager()
                ->flush();
        }

        return $this->render('@DynamicForm/admin/form/form_field_form.html.twig', ['form' => $form->createView()]);
    }
}