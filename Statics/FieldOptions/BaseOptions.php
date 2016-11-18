<?php

namespace DynamicFormBundle\Statics\FieldOptions;

use DynamicFormBundle\Entity\Value\BooleanValue;
use DynamicFormBundle\Entity\Value\StringValue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Statics\FieldOptions
 */
class BaseOptions
{
    const LABEL = [
        'name' => 'label',
        'value_class' => StringValue::class,
        'form_type' => TextType::class
    ];

    const REQUIRED = [
        'name' => 'required',
        'value_class' => BooleanValue::class,
        'form_type' => CheckboxType::class
    ];

    const DISABLED = [
        'name' => 'disabled',
        'value_class' => BooleanValue::class,
        'form_type' => CheckboxType::class
    ];

    /**
     * @return array
     */
    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);

        $options = [];

        foreach ($reflection->getConstants() as $option) {
            $name = $option['name'];
            unset($option['name']);

            $options[$name] = $option;
        }

        return $options;
    }
}