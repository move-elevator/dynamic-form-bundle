<?php

namespace DynamicFormBundle\Form\Type;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Services\FormField\OptionFilter;
use DynamicFormBundle\Statics\FormElements;
use DynamicFormBundle\Model\SortableInterface;
use DynamicFormBundle\Services\FormType\Configuration\Registry;
use DynamicFormBundle\Services\FormType\DynamicFormDataMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * @var OptionFilter
     */
    private $optionFilter;

    /**
     * @param Registry              $registry
     * @param DynamicFormDataMapper $dataMapper
     * @param OptionFilter          $optionFilter
     */
    public function __construct(Registry $registry, DynamicFormDataMapper $dataMapper, OptionFilter $optionFilter)
    {
        $this->registry = $registry;
        $this->dataMapper = $dataMapper;
        $this->optionFilter = $optionFilter;
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

        $builder->add('submit', SubmitType::class);
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

        // Create Anchor List
        foreach ($dynamicForm->findElements(FormElements::HEADLINE) as $headline) {
            $view->vars['anchor_list'][] = $headline;
        }

        $this->prepareView($view, $dynamicForm);
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
        $options = array_merge(['required' => false], $this->getFormOptions($field));
        $configuration = $this->registry->getConfiguration($field->getFormType()->getName());

        $builder->add($field->getName(), $configuration->getFormTypeClass(), $options);
    }

    /**
     * @param FormField $formField
     *
     * @return array
     */
    private function getFormOptions(FormField $formField)
    {
        $options = [];

        foreach ($formField->getOptionValues() as $optionValue) {
            $options[$optionValue->getOption()] = $optionValue->getRealValue();
        }

        $this->optionFilter->removeDisabledOptions($options);

        return $options;
    }

    /**
     * Sort all Fields by position
     *
     * @param FormView    $view
     * @param DynamicForm $form
     */
    private function prepareView(FormView $view, DynamicForm $form)
    {
        $formChildren = array_merge(
            $form->getElements()->toArray(),
            $form->getFields()->toArray()
        );

        uasort($formChildren, function (SortableInterface $first, SortableInterface $second) {
            if ($first->getPosition() == $second->getPosition()) {
                return 0;
            }

            return ($first->getPosition() < $second->getPosition()) ? -1 : 1;
        });

        $view->vars['elements'] = $formChildren;
    }
}