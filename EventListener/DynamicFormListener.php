<?php

namespace DynamicFormBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm;

/**
 * @package DynamicFormBundle\Admin\EventListener
 */
class DynamicFormListener
{
    /**
     * @ORM\PostLoad
     *
     * @param DynamicForm        $dynamicForm
     * @param LifecycleEventArgs $event
     */
    public function setFormFieldIndexToName(DynamicForm $dynamicForm, LifecycleEventArgs $event)
    {
        foreach ($dynamicForm->getFields() as $fieldValue) {
            $dynamicForm->removeField($fieldValue);
            $dynamicForm->addField($fieldValue);
        }
    }
}