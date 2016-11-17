<?php

namespace DynamicFormBundle\Twig;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use Symfony\Component\Form\FormView;

/**
 * @package DynamicFormBundle\Twig
 */
class DynamicFormExtension extends \Twig_Extension
{
    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('dynamic_form', [$this, 'dynamicForm'], ['needs_environment' => true, 'is_safe' => ['html']]),
            new \Twig_SimpleFunction('form_element', [$this, 'formElement'], ['needs_environment' => true, 'is_safe' => ['html']])
        ];
    }

    /**
     * @param \Twig_Environment $environment
     * @param FormView          $form
     *
     * @return string
     */
    public function dynamicForm(\Twig_Environment $environment, FormView $form)
    {
        return $environment->render('@DynamicForm/block/dynamic_form.twig', ['form' => $form]);
    }

    /**
     * @param \Twig_Environment $environment
     * @param FormElement       $formElement
     *
     * @return string
     */
    public function formElement(\Twig_Environment $environment, FormElement $formElement)
    {
        return $environment->render('@DynamicForm/block/form_element.html.twig', ['element' => $formElement]);
    }
}