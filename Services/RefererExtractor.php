<?php
declare(strict_types = 1);

namespace DynamicFormBundle\Services;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;

class RefererExtractor
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getRefererParams(Request $request) {
        $referer = $request->headers->get('referer');

        $baseUrl = $request->getSchemeAndHttpHost();
        $lastPath = substr($referer, strpos($referer, $baseUrl) + strlen($baseUrl));

        return $this->router->getMatcher()->match($lastPath);
    }
}