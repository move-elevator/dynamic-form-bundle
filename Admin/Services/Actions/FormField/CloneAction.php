<?php

namespace DynamicFormBundle\Admin\Services\Actions\FormField;

use Doctrine\ORM\EntityManager;
use DynamicFormBundle\Admin\Services\Actions\ActionInterface;
use DynamicFormBundle\Entity\DynamicForm\FormField;

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
     * @param FormField $object
     *
     * @return boolean
     */
    public function action($object)
    {
        if (false === $object instanceof FormField) {
            throw new \LogicException(sprintf('Only %s allowed', FormField::class));
        }

        $this->entityManager->persist(clone $object);
        $this->entityManager->flush();

        return true;
    }
}
