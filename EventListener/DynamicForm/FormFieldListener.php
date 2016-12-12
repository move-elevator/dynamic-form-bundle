<?php

namespace DynamicFormBundle\EventListener\DynamicForm;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Admin\EventListener\DynamicForm
 */
class FormFieldListener
{
    /**
     * @var Slugify
     */
    public $slugify;

    /**
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @param FormField          $formField
     * @param LifecycleEventArgs $event
     */
    public function setKey(FormField $formField, LifecycleEventArgs $event)
    {
        $formField->setKey($this->slugify->slugify($formField->getName()));
    }
}