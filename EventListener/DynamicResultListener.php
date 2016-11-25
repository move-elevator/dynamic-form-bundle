<?php

namespace DynamicFormBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicResult;

/**
 * @package DynamicFormBundle\Admin\EventListener
 */
class DynamicResultListener
{
    /**
     * @ORM\PostLoad
     *
     * @param DynamicResult      $dynamicResult
     * @param LifecycleEventArgs $event
     */
    public function setFieldValueIndexToName(DynamicResult $dynamicResult, LifecycleEventArgs $event)
    {
        foreach ($dynamicResult->getFieldValues() as $fieldValue) {
            $dynamicResult->removeFieldValue($fieldValue);
            $dynamicResult->addFieldValue($fieldValue);
        }
    }
}