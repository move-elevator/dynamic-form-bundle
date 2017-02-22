<?php

namespace DynamicFormBundle\Tests\Unit\Twig;

use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormText;
use DynamicFormBundle\Twig\FormElementExtension;

/**
 * @package DynamicFormBundle\Tests\Unit\Twig
 */
class FormElementExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormElementExtension
     */
    private $extension;

    protected function setUp()
    {
        $this->extension = new FormElementExtension();
    }

    public function testGetTestsReturnOneResult()
    {
        $this->assertCount(1, $this->extension->getTests());
    }

    public function testIsFormElementReturnFalseForAnotherClass()
    {
        $this->assertFalse($this->extension->isFormElement(new \stdClass));
    }

    public function testIsFormElementReturnTrueFormHeadline()
    {
        $this->assertTrue($this->extension->isFormElement(new FormHeadline));
    }

    public function testIsFormElementReturnTrueFormText()
    {
        $this->assertTrue($this->extension->isFormElement(new FormText));
    }
}
