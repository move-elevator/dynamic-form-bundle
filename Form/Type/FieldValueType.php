<?php

namespace DynamicFormBundle\Form\Type;

use DynamicFormBundle\Entity\DynamicResult\FieldValue;
use DynamicFormBundle\Services\FormField\OptionBuilder;
use DynamicFormBundle\Services\FormType\Configuration\Registry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Form\Type
 */
class FieldValueType extends AbstractType
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var OptionBuilder
     */
    private $optionBuilder;

    /**
     * @param Registry      $registry
     * @param OptionBuilder $optionBuilder
     */
    public function __construct(Registry $registry, OptionBuilder $optionBuilder)
    {
        $this->registry = $registry;
        $this->optionBuilder = $optionBuilder;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'buildField']);
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FieldValue::class
        ]);
    }

    /**
     * @param FormEvent $event
     */
    public function buildField(FormEvent $event)
    {
        /** @var FieldValue $fieldValue */
        $fieldValue = $event->getData();
        $formField = $fieldValue->getFormField();

        $configuration = $this->registry->getConfiguration($formField->getFormType());
        $options = array_merge([
            'required' => false,
            'label' => $formField->getName(),
            'property_path' => 'value.content'
        ], $this->optionBuilder->build($formField, $configuration));

        $event->getForm()->add($formField->getName(), $configuration->getFormTypeClass(), $options);
    }
}