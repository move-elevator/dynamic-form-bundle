<?php

namespace DynamicFormBundle\Controller\Sonata\DynamicForm;

use DynamicFormBundle\Admin\Form\Type\DynamicForm\FormElementType;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Controller\Sonata\DynamicForm
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

            $successMessage = $this
                ->get('translator')
                ->trans('successfully.saved', [], 'dynamic_form');

            $this->addFlash('success', sprintf('%s: %s', $formElementType, $successMessage));

            return $this->redirectToRoute('dynamicform_sonata_dynamicform_formelement_edit', [
                'formId' => $dynamicForm->getId(),
                'elementId' => $formElement->getId()
            ]);
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

            $elementType = $this
                ->get('translator')
                ->trans($formElement->getElementType(), [], 'dynamic_form');

            $successMessage = $this
                ->get('translator')
                ->trans('successfully.saved', [], 'dynamic_form');

            $this->addFlash('success', sprintf('%s: %s', $elementType, $successMessage));

            return $this->redirectToRoute('dynamicform_sonata_dynamicform_edit', ['id' => $dynamicForm->getId()]);
        }

        return $this->get('dynamic_form.admin.form_element.template_guesser')->render($formElement, [
            'form' => $form->createView(),
            'dynamicForm' => $dynamicForm,
            'admin_pool' => $this->container->get('sonata.admin.pool')
        ]);
    }

    /**
     * @param Request     $request
     * @param FormElement $formElement
     *
     * @Route("/{elementId}/delete")
     *
     * @ParamConverter("formElement", class="DynamicFormBundle:DynamicForm\FormElement", options={"mapping": {"elementId": "id"}})
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, FormElement $formElement)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager();
        $entityManager->remove($formElement);
        $entityManager->flush();

        $elementType = $this
            ->get('translator')
            ->trans($formElement->getElementType(), [], 'dynamic_form');

        $successMessage = $this
            ->get('translator')
            ->trans('successfully.deleted', [], 'dynamic_form');

        $this->addFlash('success', sprintf('%s: %s', $elementType, $successMessage));

        return $this->redirectToRoute($request->headers->get('referer'));
    }

    /**
     * @param Request     $request
     * @param FormElement $formElement
     *
     * @Route("/{elementId}/clone")
     *
     * @ParamConverter("formElement", class="DynamicFormBundle:DynamicForm\FormElement", options={"mapping": {"elementId": "id"}})
     *
     * @return RedirectResponse
     */
    public function cloneAction(Request $request, FormElement $formElement)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager();

        $clonedFormElement = clone $formElement;

        $entityManager->persist($clonedFormElement);
        $entityManager->flush();

        $elementType = $this
            ->get('translator')
            ->trans($formElement->getElementType(), [], 'dynamic_form');

        $successMessage = $this
            ->get('translator')
            ->trans('successfully.cloned', [], 'dynamic_form');

        $this->addFlash('success', sprintf('%s: %s', $elementType, $successMessage));

        return $this->redirectToRoute($request->headers->get('referer'));
    }
}