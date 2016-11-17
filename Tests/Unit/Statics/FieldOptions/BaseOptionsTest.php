<?php

namespace DynamicFormBundle\Tests\Unit\Statics\FieldOptions;

use DynamicFormBundle\Entity\Value\BooleanValue;
use DynamicFormBundle\Entity\Value\StringValue;
use DynamicFormBundle\Statics\FieldOptions\BaseOptions;

/**
 * @package DynamicFormBundle\Tests\Unit\Statics\FieldOptions
 */
class BaseOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testAllReturnExpectedStructure()
    {
        $expected = [
            'label' => StringValue::class,
            'required' => BooleanValue::class,
            'disabled' => BooleanValue::class,
        ];

        $this->assertEquals($expected, BaseOptions::all());
    }
}