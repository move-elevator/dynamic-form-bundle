<?php

namespace DynamicFormBundle\Model;

use Doctrine\Common\Collections\Collection;
use DynamicFormBundle\Entity\DynamicForm\FormElement;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Model
 */
abstract class DynamicForm
{
    /**
     * @return Collection|FormField[]
     */
    abstract public function getFields();

    /**
     * @return Collection|FormElement[]
     */
    abstract public function getElements();

    /**
     * @param string $fieldName
     *
     * @return bool
     */
    public function hasField($fieldName)
    {
        return $this->getFields()->containsKey($fieldName);
    }

    /**
     * @param string $elementType
     *
     * @return FormElement[]
     */
    public function findElements($elementType)
    {
        return $this->getElements()->filter(function (FormElement $element) use ($elementType) {
            if ($elementType === $element->getElementType()) {
                return true;
            }

            return false;
        });
    }
}