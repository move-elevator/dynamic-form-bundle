<?php

namespace DynamicFormBundle\Tests\Unit\Services\FormType\Configuration;

use DynamicFormBundle\Services\FormType\Configuration\TextTypeConfiguration;
use DynamicFormBundle\Statics\FormTypes;
use DynamicFormBundle\Services\FormType\Configuration\Registry;

/**
 * @package DynamicFormBundle\Tests\Unit\Services\FormType\Configuration
 */
class RegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Registry
     */
    private $registry;

    protected function setUp()
    {
        $this->registry = new Registry();
        $this->registry->addConfiguration(new TextTypeConfiguration);
    }

    public function testGetExistingConfigurationReturnObject()
    {
        $this->assertInstanceOf(TextTypeConfiguration::class, $this->registry->getConfiguration(FormTypes::TEXT));
    }

    /**
     * @expectedException \LogicException
     */
    public function testGetNoneExistingConfigurationThrowsError()
    {
        $this->registry->getConfiguration(FormTypes::DATETIME);
    }
}