<?php

namespace DynamicFormBundle\Statics\FieldOptions;

use DynamicFormBundle\Entity\Value\ArrayValue;

/**
 * @package DynamicFormBundle\Statics\FieldOptions
 */
class ChoiceOptions extends BaseOptions
{
    const CHOICES = [
        'name' => 'choices',
        'value_class' => ArrayValue::class
    ];
}