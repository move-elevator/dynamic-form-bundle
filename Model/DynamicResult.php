<?php

namespace DynamicFormBundle\Model;

use Doctrine\Common\Collections\Collection;
use DynamicFormBundle\Entity\DynamicResult\FieldValue as EntityFieldValue;

/**
 * @package DynamicFormBundle\Model
 */
abstract class DynamicResult
{
    /**
     * @return Collection|EntityFieldValue[]
     */
    abstract public function getFieldValues();

    /**
     * @param string $fieldKey
     *
     * @return FieldValue|null
     */
    public function getFieldValue($fieldKey)
    {
        foreach ($this->getFieldValues() as $fieldValue) {
            if ($fieldValue->getKey() === $fieldKey) {
                return $fieldValue;
            }
        }

        return null;
    }

    /**
     * @param string $fieldKey
     *
     * @return bool
     */
    public function hasFieldValue($fieldKey)
    {
        foreach ($this->getFieldValues() as $fieldValue) {
            if ($fieldValue->getKey() === $fieldKey) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $fieldKey
     * @param mixed  $value
     *
     * @return DynamicResult
     */
    public function setFieldValueContent($fieldKey, $value)
    {
        if (false === $this->hasFieldValue($fieldKey)) {
            throw new \BadMethodCallException(sprintf('Property "%s" does not exist', $fieldKey));
        }

        $this
            ->getFieldValue($fieldKey)
            ->getValue()
            ->setContent($value);

        return $this;
    }

    /**
     * @param string $fieldKey
     *
     * @return mixed
     */
    public function getFieldValueContent($fieldKey)
    {
        if (false === $this->hasFieldValue($fieldKey)) {
            throw new \BadMethodCallException(sprintf('Property "%s" does not exist', $fieldKey));
        }

        return $this->getFieldValue($fieldKey)->getValue()->getContent();
    }
}