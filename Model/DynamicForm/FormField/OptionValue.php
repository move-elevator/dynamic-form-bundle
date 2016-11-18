<?php

namespace  DynamicFormBundle\Model\DynamicForm\FormField;

use DynamicFormBundle\Entity\Value\BaseValue;

/**
 * @package DynamicFormBundle\Model\DynamicForm\FormField
 */
abstract class OptionValue
{
    /**
     * @return BaseValue
     */
    abstract function getValue();

    /**
     * @return mixed
     */
    public function getRealValue()
    {
        return $this
            ->getValue()
            ->getContent();
    }

    /**
     * @return mixed
     */
    public function setRealValue($value)
    {
        return $this
            ->getValue()
            ->setContent($value);
    }
}