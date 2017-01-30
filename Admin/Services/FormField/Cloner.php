<?php

namespace DynamicFormBundle\Admin\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Admin\Service
 */
class Cloner
{
    /**
     * @param FormField $formField
     *
     * @return FormField
     */
    public function createClone(FormField $formField)
    {
        $options = $formField
            ->getOptionValues()
            ->toArray();

        $copy = clone $formField;

        foreach ($options as $option) {
            $copy->addOptionValue(clone $option);
        }

        return $copy;
    }
}