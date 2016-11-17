<?php

namespace DynamicFormBundle\Tests\Unit\Services\FormType;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Entity\DynamicResult\FieldValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\FormType;
use DynamicFormBundle\Entity\Value\StringValue;
use DynamicFormBundle\Services\DynamicResultFieldBuilder;
use DynamicFormBundle\Services\FormType\Configuration\Registry;
use DynamicFormBundle\Services\FormType\Configuration\TextAreaTypeConfiguration;
use DynamicFormBundle\Services\FormType\Configuration\TextTypeConfiguration;
use DynamicFormBundle\Services\FormType\DynamicFormDataMapper;
use DynamicFormBundle\Tests\Utility\IteratorWrapper;
use Symfony\Component\Form\Form;

/**
 * @package DynamicFormBundle\Tests\Unit\Services\FormType
 */
class DynamicFormDataMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DynamicFormDataMapper
     */
    private $mapper;

    protected function setUp()
    {
        $registry = new Registry();
        $registry->addConfiguration(new TextTypeConfiguration());
        $registry->addConfiguration(new TextAreaTypeConfiguration());
        $builder = new DynamicResultFieldBuilder($registry);

        $this->mapper = new DynamicFormDataMapper($builder);
    }

    /**
     * @expectedException \LogicException
     */
    public function testThrowErrorIfNoDynamicFormIsSet()
    {
        $data = new DynamicResult();
        $this->mapper->mapFormsToData(null, $data);
    }

    public function testMapFormToDataSetValueContent()
    {
        $result = new DynamicResult();

        $dynamicForm = new DynamicForm();
        $dynamicForm->addField(new FormField('name', new FormType('text')));
        $dynamicForm->addField(new FormField('description', new FormType('textarea')));

        $form = new IteratorWrapper([
            'name' => $this->getFormFieldMock(0, 1),
            'description' => $this->getFormFieldMock(0, 1),
        ]);

        $this->mapper->setDynamicForm($dynamicForm);
        $this->mapper->mapFormsToData($form, $result);

        $this->assertEquals('content', $result->getFieldValueContent('name'));
        $this->assertEquals('content', $result->getFieldValueContent('description'));
    }

    public function testMapDataToFormSetFormDefaultValues()
    {
        $fieldValue = new FieldValue();
        $fieldValue->setFormField(new FormField('name'));
        $fieldValue->setValue(new StringValue());

        $result = new DynamicResult();
        $result->addFieldValue($fieldValue);

        $form = new IteratorWrapper([
            'name' => $this->getFormFieldMock(1),
            'description' => $this->getFormFieldMock(),
        ]);

        $this->mapper->mapDataToForms($result, $form);
    }

    public function testMapFormsToDataDoesNothingIfDataIsNoDynamicResult()
    {
        $builder = $this
            ->getMockBuilder(DynamicResultFieldBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $builder
            ->expects($this->never())
            ->method('initFields');

        $mapper = new DynamicFormDataMapper($builder);

        $mapper->mapFormsToData(null, $builder);
    }

    /**
     * @param $expectedSetData
     * @param $expectedGetData
     *
     * @return Form
     */
    private function getFormFieldMock($expectedSetData = 0, $expectedGetData = 0)
    {
        $form = $this
            ->getMockBuilder(Form::class)
            ->disableOriginalConstructor()
            ->getMock();

        $form
            ->expects($this->exactly($expectedGetData))
            ->method('getData')
            ->willReturn('content');

        $form
            ->expects($this->exactly($expectedSetData))
            ->method('setData');

        return $form;
    }
}