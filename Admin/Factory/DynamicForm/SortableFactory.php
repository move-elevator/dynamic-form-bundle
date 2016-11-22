<?php

namespace DynamicFormBundle\Admin\Factory\DynamicForm;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Model\SortableInterface;

/**
 * @package DynamicFormBundle\Admin\Factory\DynamicForm
 */
abstract class SortableFactory
{
    /**
     * @param DynamicForm $form
     *
     * @return integer
     */
    protected function calculatePosition(DynamicForm $form)
    {
        $position = 0;

        $sortableElements = array_merge(
            $form->getElements()->toArray(),
            $form->getFields()->toArray()
        );

        /** @var SortableInterface $sortable */
        foreach ($sortableElements as $sortable) {
            if ($position < $sortable->getPosition()) {
                $position = $sortable->getPosition();
            }
        }

        return ++$position;
    }
}