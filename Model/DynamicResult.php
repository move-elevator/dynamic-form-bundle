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
     * @param string $fieldName
     *
     * @return EntityFieldValue
     */
    abstract public function getFieldValue($fieldName);

    /**
     * @param string $fieldName
     *
     * @return bool
     */
    public function hasFieldValue($fieldName)
    {
        return $this->getFieldValues()->containsKey($fieldName);
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
        $property = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', substr($name, 3))), '_');

        if (false !== strpos($name, 'set')) {
            return $this->setFieldValueContent($property, current($arguments));
        }

        if (false !== strpos($name, 'get')) {
            return $this->getFieldValueContent($property);
        }

        throw new \BadMethodCallException(sprintf('Method "%s" does not exist', $name));
    }
}