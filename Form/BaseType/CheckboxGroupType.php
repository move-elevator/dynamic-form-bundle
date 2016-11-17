<?php

namespace DynamicFormBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Form\BaseType
 */
class CheckboxGroupType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'choices_as_values' => true,
            'expanded' => true,
            'multiple' => true
        ]);
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}