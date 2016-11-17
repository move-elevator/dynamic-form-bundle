<?php

namespace DynamicFormBundle\Statics\FieldOptions;

use DynamicFormBundle\Entity\Value\BooleanValue;
use DynamicFormBundle\Entity\Value\StringValue;

/**
 * @package DynamicFormBundle\Statics\FieldOptions
 */
class BaseOptions
{
    const LABEL = [
        'name' => 'label',
        'value_class' => StringValue::class
    ];

    const REQUIRED = [
        'name' => 'required',
        'value_class' => BooleanValue::class
    ];

    const DISABLED = [
        'name' => 'disabled',
        'value_class' => BooleanValue::class
    ];

    /**
     * @return array
     */
    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);

        $options = [];

        foreach ($reflection->getConstants() as $option) {
            $options[$option['name']] = $option['value_class'];
        }

        return $options;
    }
}