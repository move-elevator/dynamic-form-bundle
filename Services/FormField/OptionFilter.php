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
}