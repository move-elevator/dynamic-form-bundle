<?php

namespace DynamicFormBundle\Services\FormType;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Services\DynamicResultFieldBuilder;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Services\FormType
 */
class DynamicFormDataMapper implements DataMapperInterface
{
    /**
     * @var DynamicForm
     */
    private $dynamicForm;

    /**
     * @var DynamicResultFieldBuilder
     */
    private $fieldBuilder;

    /**
     * @param DynamicResultFieldBuilder $fieldBuilder
     */
    public function __construct(DynamicResultFieldBuilder $fieldBuilder)
    {
        $this->fieldBuilder = $fieldBuilder;
    }

    /**
     * @param DynamicResult   $data
     * @param FormInterface[] $forms
     */
    public function mapDataToForms($data, $forms)
    {
        if (!$data instanceof DynamicResult) {
            return;
        }

        $forms = iterator_to_array($forms);
        $this->fieldBuilder->initFields($data, $this->dynamicForm);

        foreach ($data->getFieldValues() as $fieldValue) {
            $name = $fieldValue->getKey();

            if (true === array_key_exists($name, $forms)) {
                $forms[$name]->setData($fieldValue->getRealValue());
            }
        }
    }

    /**
     * @param FormInterface[] $forms
     * @param DynamicResult   $data
     */
    public function mapFormsToData($forms, &$data)
    {
        if (!$data instanceof DynamicResult) {
            return;
        }

        if (null === $this->dynamicForm) {
            throw new \LogicException('dynamicForm cannot be null.');
        }

        $forms = iterator_to_array($forms);
        $this->fieldBuilder->initFields($data, $this->dynamicForm);

        foreach ($this->dynamicForm->getFields() as $field) {
            $value = $forms[$field->getKey()]->getData();

            $data->setFieldValueContent($field->getKey(), $value);
        }

        $data->setForm($this->dynamicForm);
    }

    /**
     * @param DynamicForm $dynamicForm
     */
    public function setDynamicForm(DynamicForm $dynamicForm)
    {
        $this->dynamicForm = $dynamicForm;
    }
}