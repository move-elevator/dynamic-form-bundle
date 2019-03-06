<?php

namespace DynamicFormBundle\Tests\Unit\Statics\FieldOptions;

use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use PHPUnit\Framework\TestCase;

/**
 * @package DynamicFormBundle\Tests\Unit\Statics\FieldOptions
 */
class BaseOptionsTest extends TestCase
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
