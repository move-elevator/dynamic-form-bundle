<?php

namespace DynamicFormBundle\Services\FormField;

/**
 * @package DynamicFormBundle\Services\FormField
 */
class OptionFilter
{
    /**
     * @var array
     */
    private $disabledOptions;

    /**
     * @param array $disabledOptions
     */
    public function __construct(array $disabledOptions)
    {
        $this->disabledOptions = $disabledOptions;
    }

    /**
     * @param array|\ArrayAccess $options
     *
     * @return array|\ArrayAccess
     */
    public function removeDisabledOptions(&$options)
    {
        foreach ($options as $option => $value) {
            if (true === in_array($option, $this->disabledOptions)) {
                unset($options[$option]);
            }
        }

        return $options;
    }
}