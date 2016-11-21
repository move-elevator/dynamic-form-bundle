<?php

namespace DynamicFormBundle\Admin\Controller;

use DynamicFormBundle\Admin\Form\Type\DynamicFormType;
use DynamicFormBundle\Entity\DynamicForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package DynamicFormBundle\Admin\Controller
 *
 * @Route("form")
 */
class DynamicFormController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/create")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(DynamicFormType::class);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            /** @var DynamicForm $dynamicForm */
            $dynamicForm = $form->getData();

            $entityManager = $this
                ->getDoctrine()
                ->getManager();

            $entityManager->persist($dynamicForm);
            $entityManager->flush();

            $this->redirectToRoute('dynamicform_admin_dynamicform_edit', ['id' => $dynamicForm->getId()]);
        }

        return $this->render('@DynamicForm/admin/form/dynamic_form_form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Request     $request
     * @param DynamicForm $dynamicForm
     *
     * @Route("/{id}/edit")
     *
     * @return Response
     */
    public function editAction(Request $request, DynamicForm $dynamicForm)
    {
        $form = $this->createForm(DynamicFormType::class, $dynamicForm);
        $form->handleRequest($request);

        if (true === $form->isValid()) {
            $this
                ->getDoctrine()
                ->getEntityManager()
                ->flush();
        }

        return $this->render('@DynamicForm/admin/form/dynamic_form_form.html.twig', ['form' => $form->createView(), 'dynamicForm' => $dynamicForm]);
    }
}