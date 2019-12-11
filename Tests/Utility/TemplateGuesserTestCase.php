<?php

namespace DynamicFormBundle\Tests\Utility;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

/**
 * @package DynamicFormBundle\Tests\Unit\Admin\Services
 */
class TemplateGuesserTestCase extends TestCase
{
    protected function getTwigEnvironmentMock($renderTemplatePath, array $renderParams, $existReturn = true)
    {
        $loader = $this
            ->getMockBuilder(LoaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $loader
            ->expects($this->once())
            ->method('exists')
            ->willReturn($existReturn);

        $environment = $this
            ->getMockBuilder(Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $environment
            ->expects($this->once())
            ->method('getLoader')
            ->willReturn($loader);

        $environment
            ->expects($this->once())
            ->method('render')
            ->with($renderTemplatePath, $renderParams);

        return $environment;
    }
}
