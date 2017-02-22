<?php

namespace DynamicFormBundle\Tests\Utility;

use Symfony\Component\Templating\EngineInterface;

/**
 * @package DynamicFormBundle\Tests\Unit\Admin\Services
 */
class TemplateGuesserTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $renderTemplatePath
     * @param array  $renderParams
     * @param bool   $existReturn
     *
     * @return EngineInterface
     */
    protected function getTemplateEngineMock($renderTemplatePath, array $renderParams, $existReturn = true)
    {
        $engine = $this
            ->getMockBuilder(EngineInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $engine
            ->expects($this->once())
            ->method('exists')
            ->willReturn($existReturn);

        $engine
            ->expects($this->once())
            ->method('render')
            ->with($renderTemplatePath, $renderParams);

        return $engine;
    }
}
