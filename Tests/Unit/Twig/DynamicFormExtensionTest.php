<?php

namespace DynamicFormBundle\Tests\Unit\Twig;

use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Twig\DynamicFormExtension;
use Symfony\Component\Form\FormView;

/**
 * @package DynamicFormBundle\Tests\Unit\Twig
 */
class DynamicFormExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DynamicFormExtension
     */
    private $extension;

    protected function setUp()
    {
        $this->extension = new DynamicFormExtension();
    }

    public function testGetFunctionsReturnTwoFunctions()
    {
        $this->assertCount(2, $this->extension->getFunctions());
    }

    public function testDynamicFormFunctionExecuteTwigRendererWithExpectedTemplate()
    {
        $this->extension->dynamicForm($this->getTwigEnvironment('@DynamicForm/block/dynamic_form.twig'), new FormView);
    }

    public function testFormElementFunctionExecuteTwigRendererWithExpectedTemplate()
    {
        $this->extension->formElement($this->getTwigEnvironment('@DynamicForm/block/form_element/form_headline.html.twig'), new FormHeadline);
    }

    private function getTwigEnvironment($expectedTemplate)
    {
        $environment = $this
            ->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $environment
            ->expects($this->once())
            ->method('render')
            ->with($expectedTemplate, $this->anything());

        return $environment;
    }
}