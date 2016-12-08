<?php

namespace DynamicFormBundle\Admin\Controller\Sonata\DynamicForm;

use DynamicFormBundle\Admin\Form\Type\DynamicForm\FormFieldType;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Admin\Controller\Sonata\DynamicForm
 *
 * @Route("form/{formId}/form-field")
 */
class FormFieldController extends Controller
{
    /**
     * @param Request     $request
     * @param string      $formType
     * @param DynamicForm $dynamicForm
     *
     * @Route("/{formType}/create")
     *
     * @ParamConverter("dynamicForm", class="DynamicFormBundle:DynamicForm", options={"mapping": {"formId": "id"}})
     *
     * @return Response
     */
    public function createAction(Request $request, $formType, DynamicForm $dynamicForm)
    {
        $formField = $this
            ->get('dynamic_form.admin.form_field.factory')
            ->create($dynamicForm, $formType);

        $form = $this->createForm(FormFieldType::class, $formField);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $this
                ->getDoctrine()
                ->getManager()
                ->flush($dynamicForm);
        }

        return $this->get('dynamic_form.admin.form_field.template_guesser')->render($formField, [
            'form' => $form->createView(),
            'dynamicForm' => $dynamicForm,
            'admin_pool' => $this->container->get('sonata.admin.pool')
        ]);
    }

    /**
     * @param Request     $request
     * @param DynamicForm $dynamicForm
     * @param FormField   $formField
     *
     * @Route("/{fieldId}/edit")
     *
     * @ParamConverter("formField", class="DynamicFormBundle:DynamicForm\FormField", options={"mapping": {"fieldId": "id"}})
     * @ParamConverter("dynamicForm", class="DynamicFormBundle:DynamicForm", options={"mapping": {"formId": "id"}})
     *
     * @return Response
     */
    public function editAction(Request $request, DynamicForm $dynamicForm, FormField $formField)
    {
        $this
            ->get('dynamic_form.admin.form_field.factory')
            ->initOptions($formField);

        $cleanup = $this
            ->get('dynamic_form.admin.choice.cleanup')
            ->setFormField($formField);

        $form = $this->createForm(FormFieldType::class, $formField);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $cleanup->checkRemoves();

            $this
                ->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('dynamicform_admin_sonata_dynamicform_edit', ['id' => $dynamicForm->getId()]);
        }

        return $this->get('dynamic_form.admin.form_field.template_guesser')->render($formField, [
            'form' => $form->createView(),
            'dynamicForm' => $dynamicForm,
            'admin_pool' => $this->container->get('sonata.admin.pool')
        ]);
    }
}