<?php

namespace DynamicFormBundle\Tests\Unit\Services\FormType\Configuration;

use DynamicFormBundle\Statics\FormTypes;
use DynamicFormBundle\Services\FormType\Configuration\Registry;
use DynamicFormBundle\Services\FormType\Configuration\ContactConfiguration;

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
        $this->registry->addConfiguration(new ContactConfiguration());
    }

    public function testGetExistingConfigurationReturnObject()
    {
        $this->assertInstanceOf(ContactConfiguration::class, $this->registry->getConfiguration(FormTypes::TEXT));
    }

    /**
     * @expectedException \LogicException
     */
    public function testGetNoneExistingConfigurationThrowsError()
    {
        $this->registry->getConfiguration(FormTypes::DATETIME);
    }
}