<?php

namespace DynamicFormBundle\Tests\Unit\Statics\FieldOptions;

use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;

/**
 * @package DynamicFormBundle\Tests\Unit\Statics\FieldOptions
 */
class BaseOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testAllReturnExpectedStructure()
    {
        $expected = [
            'LABEL' => 'label',
            'REQUIRED' => 'required',
            'DISABLED' => 'disabled',
            'PLACEHOLDER' => 'placeholder'
        ];

        $this->assertEquals($expected, BaseOptions::all());
    }
}
