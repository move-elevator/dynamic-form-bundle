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
     * @param string $fieldName
     * @param mixed  $value
     *
     * @return DynamicResult
     */
    public function setFieldValueContent($fieldName, $value)
    {
        if (false === $this->hasFieldValue($fieldName)) {
            throw new \BadMethodCallException(sprintf('Property "%s" does not exist', $fieldName));
        }

        $this
            ->getFieldValue($fieldName)
            ->getValue()
            ->setContent($value);

        return $this;
    }

    /**
     * @param string $fieldName
     *
     * @return mixed
     */
    public function getFieldValueContent($fieldName)
    {
        if (false === $this->hasFieldValue($fieldName)) {
            throw new \BadMethodCallException(sprintf('Property "%s" does not exist', $fieldName));
        }

        return $this->getFieldValue($fieldName)->getValue()->getContent();
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $property = ltrim(strtolower(preg_replace('/[A-Z]/', '-$0', substr($name, 3))), '-');

        if (false !== strpos($name, 'set')) {
            return $this->setFieldValueContent($property, current($arguments));
        }

        if (false !== strpos($name, 'get')) {
            return $this->getFieldValueContent($property);
        }

        throw new \BadMethodCallException(sprintf('Method "%s" does not exist', $name));
    }
}