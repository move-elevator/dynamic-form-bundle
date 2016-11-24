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
        foreach ($this->disabledOptions as $option) {
            if (true === isset($options[$option])) {
                unset($options[$option]);
            }
        }

        return $options;
    }

    /**
     * @param array|\ArrayAccess $options
     *
     * @return array
     */
    public function filterDisabledOptions($options)
    {
        $filtered = [];

        foreach ($options as $option => $value) {
            if (false === in_array($option, $this->disabledOptions)) {
                $filtered[$option] = $value;
            }
        }

        return $filtered;
    }
}