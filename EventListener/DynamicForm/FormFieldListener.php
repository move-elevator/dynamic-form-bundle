<?php

namespace DynamicFormBundle\EventListener\DynamicForm;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Admin\EventListener\DynamicForm
 */
class FormFieldListener
{
    /**
     * @ORM\PostLoad
     *
     * @param FormField          $formField
     * @param LifecycleEventArgs $event
     */
    public function setOptionIndexToName(FormField $formField, LifecycleEventArgs $event)
    {
        foreach ($formField->getOptionValues() as $optionValue) {
            $formField->removeOptionValue($optionValue);
            $formField->addOptionValue($optionValue);
        }
    }
}