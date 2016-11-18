<?php

namespace DynamicFormBundle\Admin\Form\Type\DynamicForm\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Admin\Form\Type\DynamicForm
 */
class OptionValueType extends AbstractType
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
        $builder->addEventListener(FormEvents::POST_SET_DATA, [$this, 'addValueField']);
    }

    /**
     * @param FormEvent $event
     */
    public function addValueField(FormEvent $event)
    {
        /** @var OptionValue $option */
        $option = $event->getData();

        if (null === $option->getName()) {
            throw new \LogicException('No option set');
        }

        $configuration = $this->registry->getConfiguration($option->getName());

        $event->getForm()->add($option->getName(), $configuration->getFormTypeClass(), [
            'required' => false,
            'empty_data' => $configuration->getDefaultValue(),
            'property_path' => 'value.content'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OptionValue::class,
            'label' => false
        ]);
    }
}