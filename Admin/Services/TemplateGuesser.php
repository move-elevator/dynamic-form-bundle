<?php

namespace DynamicFormBundle\Admin\Services;

use Twig\Environment;

/**
 * @package AppBundle\Service
 */
abstract class TemplateGuesser
{
    /**
     * @var Environment
     */
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @throws \LogicException
     */
    protected function getTemplatePath($folder, $name)
    {
        $path = sprintf('@DynamicForm/sonata-admin/form/%s/%s.html.twig', $folder, $name);

        if (true === $this->twig->getLoader()->exists($path)) {
            return $path;
        }

        return sprintf('@DynamicForm/sonata-admin/form/%s.html.twig', $folder);
    }
}
