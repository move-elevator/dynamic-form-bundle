<?php

namespace DynamicFormBundle\Statics\FieldOptions;

use DynamicFormBundle\Entity\Value\StringValue;

/**
 * @package DynamicFormBundle\Statics\FieldOptions
 */
class DateTimeOptions extends BaseOptions
{
    const FORMAT = [
        'name' => 'format',
        'value_class' => StringValue::class
    ];
}