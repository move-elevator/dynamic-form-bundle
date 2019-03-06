<?php

namespace DynamicFormBundle\Tests\Unit\Model;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormText;
use DynamicFormBundle\Statics\FormElements;
use PHPUnit\Framework\TestCase;

/**
 * @package DynamicFormBundle\Tests\Unit\Model
 */
class DynamicFormTest extends TestCase
{
    /**
     * @var DynamicForm
     */
    private $form;

    protected function setUp()
    {
        $this->form = new DynamicForm();
    }

    public function testHasFieldWithFieldReturnTrue()
    {
        $this->form->addField(new FormField('name', null, 'name'));

        $this->assertTrue($this->form->hasField('name'));
    }

    public function testGetFieldReturnObjectIfExist()
    {
        $this->form->addField(new FormField('name', null, 'name'));

        $this->assertInstanceOf(FormField::class, $this->form->getField('name'));
    }

    public function testGetFieldReturnNullIfNotExist()
    {
        $this->form->addField(new FormField('name', null, 'name'));
        $this->assertNull($this->form->getField('not-exist'));
    }

    public function testFindElementsFilterExpectedType()
    {
        $this->form->addElement(new FormText());
        $this->form->addElement(new FormText());
        $this->form->addElement(new FormHeadline());

        $descriptions = $this->form->findElements(FormElements::TEXT);

        $this->assertCount(2, $descriptions);
    }

    public function testGetOrderElementsSortAndMergeAsExpected()
    {
        $formField = new FormField();
        $formField->setPosition(3);

        $formHeadline = new FormHeadline();
        $formHeadline->setPosition(1);

        $formText = new FormText();
        $formText->setPosition(2);

        $this->form->addField($formField);
        $this->form->addElement($formText);
        $this->form->addElement($formHeadline);

        $sorted = $this->form->getOrderedElements();

        $this->assertEquals($formHeadline, current($sorted));
        $this->assertEquals($formText, next($sorted));
        $this->assertEquals($formField, next($sorted));
    }
}
