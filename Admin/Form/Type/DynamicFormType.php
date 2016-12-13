<?php

namespace DynamicFormBundle\Admin\Form\Type;

use DynamicFormBundle\Admin\Form\Type\DynamicForm\PositionType;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Admin\Form\Type
 */
class DynamicFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false
            ])
            ->add('fields', CollectionType::class, [
                'entry_type' => PositionType::class
            ])
            ->add('elements', CollectionType::class, [
                'entry_type' => PositionType::class
            ]);
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     *
     * @return void
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['sortable'] = [];

        foreach ($view->children['fields'] as $fieldView) {
            /** @var FormField $formField */
            $formField = $fieldView->vars['value'];
            $fieldView->vars['position'] = $formField->getPosition();
            $fieldView->vars['title'] = $formField->getName();

            $view->vars['sortable'][] = $fieldView;
        }

        foreach ($view->children['elements'] as $elementView) {
            /** @var FormElement $formElement */
            $formElement = $elementView->vars['value'];
            $elementView->vars['position'] = $formElement->getPosition();
            $elementView->vars['title'] = $formElement->getText();

            $view->vars['sortable'][] = $elementView;
        }

        unset($view->children['fields'], $view->children['elements']);

        uasort($view->vars['sortable'], function (FormView $first, FormView $second) {
            if ($first->vars['position'] == $second->vars['position']) {
                return 0;
            }

            return ($first->vars['position'] < $second->vars['position']) ? -1 : 1;
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DynamicForm::class
        ]);
    }
}