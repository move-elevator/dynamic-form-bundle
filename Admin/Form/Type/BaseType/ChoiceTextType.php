<?php

namespace DynamicFormBundle\Admin\Form\Type\BaseType;

use Doctrine\ORM\EntityManager;
use DynamicFormBundle\Entity\DynamicForm\Choice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package DynamicFormBundle\Admin\Form\Type\BaseType
 */
class ChoiceTextType extends AbstractType implements DataTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Choice::class,
            'label' => false
        ]);
    }

    /**
     * @param Choice $value
     *
     * @return string
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @param string $value
     *
     * @return Choice
     */
    public function reverseTransform($value)
    {
        $choice = $this->entityManager->getRepository(Choice::class)->findOneBy([
            'value' => $value,
        ]);

        if ($choice instanceof Choice) {
            return $choice;
        }

        return new Choice($value, $value);
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return TextType::class;
    }
}