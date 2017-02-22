<?php

namespace DynamicFormBundle\Tests\Unit\Model;

use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Entity\DynamicResult\ResultValue\StringValue;
use DynamicFormBundle\Entity\DynamicResult\FieldValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\Tests\Unit\Model
 */
class DynamicResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DynamicResult
     */
    private $result;

    protected function setUp()
    {
        $this->result = new DynamicResult();
    }

    public function testHasFieldWithFieldReturnTrue()
    {
        $fieldValue = new FieldValue();
        $fieldValue->setFormField(new FormField('name', null, 'name'));
        $this->result->addFieldValue($fieldValue);

        $this->assertTrue($this->result->hasFieldValue('name'));
    }

    public function testGetFieldWithFieldReturnField()
    {
        $fieldValue = new FieldValue();
        $fieldValue->setFormField(new FormField('name', null, 'name'));
        $this->result->addFieldValue($fieldValue);

        $this->assertEquals($fieldValue, $this->result->getFieldValue('name'));
    }

    public function testFieldValueHelperFunction()
    {
        $fieldValue = new FieldValue();
        $fieldValue->setFormField(new FormField('name', null, 'name'));
        $fieldValue->setValue(new StringValue);

        $this->result->addFieldValue($fieldValue);
        $this->result->setFieldValueContent('name', 'test');

        $this->assertEquals('test', $this->result->getFieldValueContent('name'));
    }
}
