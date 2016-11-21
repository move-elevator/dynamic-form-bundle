<?php

namespace DynamicFormBundle\Admin\Form\Type\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @package DynamicFormBundle\Admin\Form\Type\BaseType
 */
class ChoiceTextType extends AbstractType implements DataTransformerInterface
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function transform($value)
    {
        return implode(', ', $value);
    }

    /**
     * @param mixed $value
     *
     * @return array
     */
    public function reverseTransform($value)
    {
        $choices = explode(',', $value);
        $choices = array_map('trim', $choices);

        foreach ($choices as $key => $choice) {
            unset($choices[$key]);
            $choices[$choice] = $choice;
        }

        return $choices;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return TextType::class;
    }
}