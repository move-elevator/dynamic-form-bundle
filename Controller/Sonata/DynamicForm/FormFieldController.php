<?php

namespace DynamicFormBundle\Controller\Sonata\DynamicForm;

use DynamicFormBundle\Admin\Form\Type\DynamicForm\FormFieldType;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Controller\Sonata\DynamicForm
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

            $entityManager = $this
                ->getDoctrine()
                ->getManager();

            $dynamicForm->addField($formField);
            $entityManager->persist($formField);
            $entityManager->flush();

            $successMessage = $this
                ->get('translator')
                ->trans('successfully.saved', [], 'dynamic_form');

            $this->addFlash('success', sprintf('%s: %s', $formType, $successMessage));

            return $this->redirectToRoute('dynamicform_sonata_dynamicform_formfield_edit', [
                'formId' => $dynamicForm->getId(),
                'fieldId' => $formField->getId()
            ]);
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

            $fieldName = $this
                ->get('translator')
                ->trans($formField->getName(), [], 'dynamic_form');

            $successMessage = $this
                ->get('translator')
                ->trans('successfully.saved', [], 'dynamic_form');

            $this->addFlash('success', sprintf('%s: %s', $fieldName, $successMessage));

            return $this->redirectToRoute('dynamicform_sonata_dynamicform_edit', ['id' => $dynamicForm->getId()]);
        }

        return $this->get('dynamic_form.admin.form_field.template_guesser')->render($formField, [
            'form' => $form->createView(),
            'dynamicForm' => $dynamicForm,
            'admin_pool' => $this->container->get('sonata.admin.pool')
        ]);
    }

    /**
     * @param Request   $request
     * @param FormField $formField
     *
     * @Route("/{fieldId}/delete")
     *
     * @ParamConverter("formField", class="DynamicFormBundle:DynamicForm\FormField", options={"mapping": {"fieldId": "id"}})
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, FormField $formField)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager();
        $entityManager->remove($formField);
        $entityManager->flush();

        $fieldName = $this
            ->get('translator')
            ->trans($formField->getName(), [], 'dynamic_form');

        $successMessage = $this
            ->get('translator')
            ->trans('successfully.deleted', [], 'dynamic_form');

        $this->addFlash('success', sprintf('%s: %s', $fieldName, $successMessage));

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @param Request   $request
     * @param FormField $formField
     *
     * @Route("/{fieldId}/clone")
     *
     * @ParamConverter("formField", class="DynamicFormBundle:DynamicForm\FormField", options={"mapping": {"fieldId": "id"}})
     *
     * @return RedirectResponse
     */
    public function cloneAction(Request $request, FormField $formField)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager();

        $clonedFormElement = clone $formField;

        $entityManager->persist($clonedFormElement);
        $entityManager->flush();

        $fieldName = $this
            ->get('translator')
            ->trans($formField->getFormType(), [], 'dynamic_form');

        $successMessage = $this
            ->get('translator')
            ->trans('successfully.cloned', [], 'dynamic_form');

        $this->addFlash('success', sprintf('%s: %s', $fieldName, $successMessage));

        return $this->redirect($request->headers->get('referer'));
    }
}