<?php

namespace DynamicFormBundle\Tests\Unit\Services\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\DisabledConfiguration;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\RequiredConfiguration;
use DynamicFormBundle\Services\FormField\OptionFilter;

/**
 * @package DynamicFormBundle\Tests\Unit\Services\FormField
 */
class OptionFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testDoNothingWithoutDisabledOptions()
    {
        $filter = new OptionFilter([]);

        $options = [
            'required' => new RequiredConfiguration(),
            'disabled' => new DisabledConfiguration(),
        ];

        $filter->removeDisabledOptions($options);

        $this->assertCount(2, $options);
    }
    public function testRemovedDisabledOptions()
    {
        $filter = new OptionFilter(['disabled']);

        $options = [
            'required' => new RequiredConfiguration(),
            'disabled' => new DisabledConfiguration(),
        ];

        $filter->removeDisabledOptions($options);

        $this->assertCount(1, $options);
        $this->assertArrayHasKey('required', $options);
        $this->assertArrayNotHasKey('disabled', $options);
    }
}