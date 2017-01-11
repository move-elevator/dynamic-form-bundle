<?php

namespace DynamicFormBundle\Admin\Services\Actions\FormField;

use Doctrine\ORM\EntityManager;
use DynamicFormBundle\Admin\Services\Actions\ActionInterface;
use DynamicFormBundle\Admin\Services\FormField\Cloner;
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
     * @var Cloner
     */
    private $cloner;

    /**
     * @param EntityManager $entityManager
     * @param Cloner        $cloner
     */
    public function __construct(EntityManager $entityManager, Cloner $cloner)
    {
        $this->entityManager = $entityManager;
        $this->cloner = $cloner;
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

        $clonedField = $this->cloner->createClone($object);

        $this->entityManager->persist($clonedField);
        $this->entityManager->flush();

        return true;
    }
}