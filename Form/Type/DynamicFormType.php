<?php

namespace DynamicFormBundle\Form\Type;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Services\FormField\OptionBuilder;
use DynamicFormBundle\Statics\FormElements;
use DynamicFormBundle\Services\FormType\Configuration\Registry;
use DynamicFormBundle\Services\FormType\DynamicFormDataMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Form\Type
 */
class DynamicFormType extends AbstractType
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var DynamicFormDataMapper
     */
    private $dataMapper;

    /**
     * @var OptionBuilder
     */
    private $optionBuilder;

    /**
     * @param Registry              $registry
     * @param DynamicFormDataMapper $dataMapper
     * @param OptionBuilder         $optionBuilder
     */
    public function __construct(Registry $registry, DynamicFormDataMapper $dataMapper, OptionBuilder $optionBuilder)
    {
        $this->registry = $registry;
        $this->dataMapper = $dataMapper;
        $this->optionBuilder = $optionBuilder;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->dataMapper->setDynamicForm($options['dynamic_form']);

        foreach ($options['dynamic_form']->getFields() as $field) {
            $this->buildField($builder, $field);
        }

        $builder->setDataMapper($this->dataMapper);
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        /** @var DynamicForm $dynamicForm */
        $dynamicForm = $options['dynamic_form'];
        $view->vars['anchor_list'] = [];

        // Create Anchor List
        foreach ($dynamicForm->findElements(FormElements::HEADLINE) as $headline) {
            $view->vars['anchor_list'][] = $headline;
        }

        $view->vars['elements'] = $dynamicForm->getOrderedElements();
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['dynamic_form'])
            ->addAllowedTypes('dynamic_form', DynamicForm::class);

        $resolver->setDefaults([
            'data_class' => DynamicResult::class
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param FormField            $field
     */
    private function buildField(FormBuilderInterface $builder, FormField $field)
    {
        $configuration = $this->registry->getConfiguration($field->getFormType());
        $options = array_merge(['required' => false], $this->optionBuilder->build($field, $configuration));

        $builder->add($field->getName(), $configuration->getFormTypeClass(), $options);
    }
}