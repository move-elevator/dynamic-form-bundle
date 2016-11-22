<?php

namespace DynamicFormBundle\Admin\Services;

use Symfony\Component\Templating\EngineInterface;

/**
 * @package AppBundle\Service
 */
abstract class TemplateGuesser
{
    /**
     * @var EngineInterface
     */
    protected $templateEngine;

    /**
     * @param EngineInterface $templateEngine
     */
    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param string $folder
     * @param string $name
     *
     * @return string
     *
     * @throws \LogicException
     */
    protected function getTemplatePath($folder, $name)
    {
        $path = sprintf('@DynamicForm/sonata-admin/form/%s/%s.html.twig', $folder, $name);

        if (true === $this->templateEngine->exists($path)) {
            return $path;
        }

        return sprintf('@DynamicForm/sonata-admin/form/%s.html.twig', $folder);
    }
}
