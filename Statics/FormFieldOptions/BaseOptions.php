<?php

namespace DynamicFormBundle\Statics\FormFieldOptions;

/**
 * @package DynamicFormBundle\Statics\FieldOptions
 */
class BaseOptions
{
    const LABEL = 'label';
    const REQUIRED = 'required';
    const DISABLED = 'disabled';

    /**
     * @return array
     */
    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);

        return $reflection->getConstants();
    }
}