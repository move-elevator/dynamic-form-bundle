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
class ChoiceType extends AbstractType implements DataTransformerInterface
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
        $builder
            ->add('value', TextType::class, [
                'label' => 'value'
            ])
            ->addModelTransformer($this);
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
     * @return Choice
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @param Choice $value
     *
     * @return Choice
     */
    public function reverseTransform($value)
    {
        $choice = $this->entityManager->getRepository(Choice::class)->findOneBy([
            'value' => $value->getValue(),
        ]);

        if ($choice instanceof Choice) {
            return $choice;
        }

        $value->setLabel($value->getValue());

        return $value;
    }
}