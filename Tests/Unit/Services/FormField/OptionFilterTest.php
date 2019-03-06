<?php

namespace DynamicFormBundle\Tests\Unit\Services\FormField;

use Doctrine\Common\Collections\ArrayCollection;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\DisabledConfiguration;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\RequiredConfiguration;
use DynamicFormBundle\Services\FormField\OptionFilter;
use PHPUnit\Framework\TestCase;

/**
 * @package DynamicFormBundle\Tests\Unit\Services\FormField
 */
class OptionFilterTest extends TestCase
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

        $options = new ArrayCollection([
            'required' => new RequiredConfiguration(),
            'disabled' => new DisabledConfiguration(),
        ]);

        $filter->removeDisabledOptions($options);

        $this->assertCount(1, $options);
        $this->assertArrayHasKey('required', $options);
        $this->assertArrayNotHasKey('disabled', $options);
    }

    public function testFilterDisabledOptions()
    {
        $filter = new OptionFilter(['disabled']);

        $options = new ArrayCollection([
            'required' => new RequiredConfiguration(),
            'disabled' => new DisabledConfiguration(),
        ]);

        $filteredOptions = $filter->filterDisabledOptions($options);

        $this->assertCount(1, $filteredOptions);
        $this->assertArrayHasKey('required', $filteredOptions);
        $this->assertArrayNotHasKey('disabled', $filteredOptions);
    }
}
