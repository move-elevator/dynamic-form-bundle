<?php

namespace DynamicFormBundle\Tests\Unit\Services\FormField;

use DynamicFormBundle\Entity\DynamicForm\ConfigValue\BooleanValue;
use DynamicFormBundle\Entity\DynamicForm\ConfigValue\StringValue;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Services\FormField\OptionBuilder;
use DynamicFormBundle\Services\FormField\OptionFilter;
use DynamicFormBundle\Services\FormType\Configuration\TextTypeConfiguration;

/**
 * @package DynamicFormBundle\Tests\Unit\Services\FormField
 */
class OptionBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OptionBuilder
     */
    private $builder;

    protected function setUp()
    {
        $this->builder = new OptionBuilder(new OptionFilter(['disabled']));
    }

    public function testBuildUnfilteredOptions()
    {
        $value = new BooleanValue();
        $value->setContent(true);

        $formField = new FormField();
        $formField->addOptionValue(new OptionValue('required', 'required', $value));
        $formField->addOptionValue(new OptionValue('empty_data', 'empty_data', $value));

        $options = $this->builder->build($formField, new TextTypeConfiguration());

        $this->assertEquals(['required' => true, 'empty_data' => true], $options);
    }

    public function testBuildFilteredOptions()
    {
        $value = new BooleanValue();
        $value->setContent(true);

        $formField = new FormField();
        $formField->addOptionValue(new OptionValue('required', 'required', $value));
        $formField->addOptionValue(new OptionValue('disabled', 'disabled', $value));

        $options = $this->builder->build($formField, new TextTypeConfiguration());

        $this->assertEquals(['required' => true], $options);
    }

    public function testBuildAttributeOptions()
    {
        $value = new StringValue();
        $value->setContent('Placeholder');

        $formField = new FormField();
        $formField->addOptionValue(new OptionValue('placeholder', 'attr.placeholder', $value));
        $formField->addOptionValue(new OptionValue('class', 'attr.class', $value));

        $options = $this->builder->build($formField, new TextTypeConfiguration());

        $this->assertEquals(['attr' => ['placeholder' => 'Placeholder', 'class' => 'Placeholder']], $options);
    }
}
