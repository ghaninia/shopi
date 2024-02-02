<?php

namespace Shopi\Core;

use Shopi\Exceptions\NotFoundException;
use Shopi\Resource\RestResponse;
use Shopi\Utils\DependencyInjector;
use const Shopi\Resource\HTTP_NOT_FOUND;

class Router
{
    private $routeMap;
    private $di;
    private static $regexPatterns = [
        'number' => '\d+',
        'string' => '\w'
    ];

    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->routeMap = include __DIR__ . '/config/routes.php';
    }

    public function route(Request $request): string
    {
        try {
            $path = $request->getPath();
            $requestMethod = $request->getMethod();

            foreach ($this->routeMap as $route => $infoDataType) {
                $regexRoute = $this->getRegexRoute($route, $infoDataType);
                $method = $infoDataType["HTTP_METHOD"] ?? Request::GET;
                if (preg_match("@^/$regexRoute$@", $path) && $method == $requestMethod) {
                    return $this->executeController($route, $path, $infoDataType, $request);
                }
            }
            throw new NotFoundException("controller not found.");
        } catch (\Throwable $exception) {
            (new RestResponse(HTTP_NOT_FOUND))->message($exception->getMessage())->echo();
        }
    }

    private function getRegexRoute(string $route, array $info): string
    {
        if (isset($info['params'])) {
            foreach ($info['params'] as $name => $type) {
                $route = str_replace(':' . $name, self::$regexPatterns[$type], $route);
            }
        }
        return $route;
    }

    private function executeController(string $route, string $path, array $info, Request $request)
    {
        $controller = new $info['controller']($this->di, $request);
        $params = $this->extractParams($route, $path);
        return call_user_func_array([$controller, $info['method']], $params);
    }

    private function extractParams(string $route, string $path): array
    {
        $params = [];
        $pathParts = explode('/', $path);
        $routeParts = explode('/', $route);
        foreach ($routeParts as $key => $routePart) {
            if (strpos($routePart, ':') === 0) {
                $name = substr($routePart, 1);
                $params[$name] = $pathParts[$key + 1];
            }
        }
        return $params;
    }
}