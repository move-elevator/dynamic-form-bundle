<?php

namespace DynamicFormBundle\Admin\Services\Actions\FormElement;

use Doctrine\ORM\EntityManager;
use DynamicFormBundle\Admin\Services\Actions\ActionInterface;
use DynamicFormBundle\Entity\DynamicForm\FormElement;

/**
 * @package DynamicFormBundle\Admin\Services
 */
class CloneAction implements ActionInterface
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
     * @param FormElement $object
     *
     * @return boolean
     */
    public function action($object)
    {
        if (false === $object instanceof FormElement) {
            throw new \LogicException(sprintf('Only %s allowed', FormElement::class));
        }

        $this->entityManager->persist(clone $object);
        $this->entityManager->flush();

        return true;
    }
}
