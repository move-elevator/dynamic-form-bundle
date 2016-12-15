<?php

namespace DynamicFormBundle\Admin\Form\Type\DynamicForm;

use Cocur\Slugify\Slugify;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldConfigurator;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Services\FormType\Configuration\Registry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Admin\Form\Type\DynamicForm
 */
class FormFieldType extends AbstractType implements DataMapperInterface
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var OptionFieldConfigurator
     */
    private $configurator;

    /**
     * @var Slugify
     */
    public $slugify;

    /**
     * @param Registry                $registry
     * @param OptionFieldConfigurator $configurator
     * @param Slugify                 $slugify
     */
    public function __construct(Registry $registry, OptionFieldConfigurator $configurator, Slugify $slugify)
    {
        $this->registry = $registry;
        $this->configurator = $configurator;
        $this->slugify = $slugify;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'addOptionFields'])
            ->setDataMapper($this);
    }

    /**
     * @param FormEvent $event
     */
    public function addOptionFields(FormEvent $event)
    {
        /** @var FormField $formField */
        $formField = $event->getData();

        $this->configurator->configFields($event->getForm(), $formField);
    }

    /**
     * @param FormField       $data
     * @param FormInterface[] $forms
     */
    public function mapDataToForms($data, $forms)
    {
        if (!$data instanceof FormField) {
            return;
        }

        $forms = iterator_to_array($forms);

        if (true === array_key_exists('name', $forms)) {
            $forms['name']->setData($data->getName());
        }

        $this->configurator->mapToForms($data, $forms);
    }

    /**
     * @param FormInterface[] $forms
     * @param FormField       $data
     */
    public function mapFormsToData($forms, &$data)
    {
        if (!$data instanceof FormField) {
            return;
        }

        $forms = iterator_to_array($forms);

        if (true === array_key_exists('name', $forms)) {
            $name = $forms['name']->getData();
            $data->setName($name);
        }

        $this->configurator->mapToOptionValues($data, $forms);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormField::class,
        ]);
    }
}