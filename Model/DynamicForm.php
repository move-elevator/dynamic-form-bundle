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
     * @param string $name
     *
     * @return FormField|null
     */
    public function getField($name)
    {
        foreach ($this->getFields() as $field) {
            if ($field->getKey() === $name) {
                return $field;
            }
        }

        return null;
    }

    /**
     * @param string $fieldKey
     *
     * @return bool
     */
    public function hasField($fieldKey)
    {
        foreach ($this->getFields() as $field) {
            if ($field->getKey() === $fieldKey) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $elementType
     *
     * @return FormElement[]
     */
    public function findElements($elementType)
    {
        $result = $this->getElements()->filter(function (FormElement $element) use ($elementType) {
            if ($elementType === $element->getElementType()) {
                return true;
            }

            return false;
        })->toArray();

        return $this->orderElements($result);
    }

    /**
     * @return SortableInterface[]
     */
    public function getOrderedElements()
    {
        $formChildren = array_merge(
            $this->getElements()->toArray(),
            $this->getFields()->toArray()
        );

        return $this->orderElements($formChildren);
    }

    /**
     * @param array $elements
     *
     * @return array
     */
    private function orderElements(array &$elements)
    {
        uasort($elements, function (SortableInterface $first, SortableInterface $second) {
            if ($first->getPosition() == $second->getPosition()) {
                return 0;
            }

            return ($first->getPosition() < $second->getPosition()) ? -1 : 1;
        });

        return $elements;
    }
}
