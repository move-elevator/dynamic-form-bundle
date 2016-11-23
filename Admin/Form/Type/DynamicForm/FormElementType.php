<?php

namespace DynamicFormBundle\Admin\Form\Type\DynamicForm;

use DynamicFormBundle\Admin\Services\FormElement\Configuration\Registry;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Admin\Form\Type\DynamicForm
 */
class FormElementType extends AbstractType
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::POST_SET_DATA, [$this, 'addFields']);
    }

    /**
     * @param FormEvent $event
     */
    public function addFields(FormEvent $event)
    {
        /** @var FormElement $formElement */
        $formElement = $event->getData();

        $configuration = $this->registry->getConfiguration($formElement->getElementType());

        $event->getForm()->add('text', $configuration->getFormTypeClass());
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormElement::class,
        ]);
    }
}