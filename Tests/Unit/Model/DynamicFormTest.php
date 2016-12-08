<?php

namespace DynamicFormBundle\Tests\Unit\Model;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormText;
use DynamicFormBundle\Statics\FormElements;

/**
 * @package DynamicFormBundle\Tests\Unit\Model
 */
class DynamicFormTest extends \PHPUnit_Framework_TestCase
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

    public function testFindElementsFilterExpectedType()
    {
        $this->form->addElement(new FormText());
        $this->form->addElement(new FormText());
        $this->form->addElement(new FormHeadline());

        $descriptions = $this->form->findElements(FormElements::TEXT);

        $this->assertCount(2, $descriptions);
    }
}