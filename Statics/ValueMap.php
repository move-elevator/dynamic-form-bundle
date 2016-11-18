<?php

namespace DynamicFormBundle\Statics;
use DynamicFormBundle\Entity\Value\BooleanValue;
use DynamicFormBundle\Entity\Value\DateTimeValue;
use DynamicFormBundle\Entity\Value\StringValue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package DynamicFormBundle\Statics
 */
class ValueMap
{
    const VALUE_TO_FORM_TYPE = [
        StringValue::class => TextType::class,
        TextareaType::class => TextareaType::class,
        BooleanValue::class => CheckboxType::class,
        DateTimeValue::class => DateTimeType::class
    ];
}