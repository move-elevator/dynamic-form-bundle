<?php

namespace DynamicFormBundle\Services;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Entity\DynamicResult\FieldValue;
use DynamicFormBundle\Services\FormType\Configuration\Registry;

/**
 * @package DynamicFormBundle\Services
 */
class DynamicResultFieldBuilder
{
    /**
     * @var Registry
     */
    private $configRegistry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->configRegistry = $registry;
    }

    /**
     * @param DynamicResult $results
     * @param DynamicForm   $form
     */
    public function initFields(DynamicResult $results, DynamicForm $form)
    {
        foreach ($results->getFieldValues() as $fieldValue) {
            if (false === $form->hasField($fieldValue->getKey())) {
                $results->removeFieldValue($fieldValue);
            }
        }

        foreach ($form->getFields() as $field) {
            if (true === $results->hasFieldValue($field->getKey())) {
                continue;
            }

            $config = $this->configRegistry->getConfiguration($field->getFormType());
            $valueClass = $config->getValueClass();
            $value = new $valueClass;

            $fieldValue = new FieldValue();
            $fieldValue->setFormField($field);
            $fieldValue->setValue($value);
            $results->addFieldValue($fieldValue);
        }
    }
}
