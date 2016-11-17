<?php

namespace DynamicFormBundle\Model;

use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\Value\BaseValue;

/**
 * @package DynamicFormBundle\Model
 */
abstract class FieldValue
{
    /**
     * @return FormField
     */
    abstract public function getFormField();

    /**
     * @return BaseValue
     */
    abstract public function getValue();

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getFormField()->getName();
    }

    /**
     * @return mixed
     */
    public function getRealValue()
    {
        return $this->getValue()->getContent();
    }
}