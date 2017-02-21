<?php

namespace DynamicFormBundle\Services\FormType\Configuration;

use DynamicFormBundle\Entity\DynamicResult\ResultValue\FileValue;
use DynamicFormBundle\Services\FormType\ConfigurationInterface;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\FormTypes;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * @package DynamicFormBundle\Services\FormType\Configuration
 */
class FileTypeConfiguration implements ConfigurationInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return FormTypes::FILE;
    }

    /**
     * @return string
     */
    public function getFormTypeClass()
    {
        return FileType::class;
    }

    /**
     * @return string
     */
    public function getValueClass()
    {
        return FileValue::class;
    }

    /**
     * @return array
     */
    public function getAvailableOptions()
    {
        return BaseOptions::all();
    }
}
