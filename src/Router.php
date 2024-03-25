<?php

namespace ASCMedia\SimpleSiteBuilder;

use Exception;

class Router
{
    public function map($routesMap, $notFound, $error): void
    {
        $request = App::getInstance()->getRequest();
        $routes = explode('/', $request->server('REQUEST_URI'));
        array_shift($routes);

        if (str_contains($routes[count($routes) - 1], '?')) {
            $routes[count($routes) - 1] = explode('?', $routes[count($routes) - 1])[0];
        }

        if (empty($routes[count($routes) - 1]) && count($routes) > 1) {
            array_pop($routes);
        }

        foreach ($routesMap as $routeMap) {
            if ($routes === $routeMap['route'] && $request->server('REQUEST_METHOD') === $routeMap['method']) {
                try {
                    $routeMap['function']();
                } catch (Exception $e) {
                    $error($e);
                }
                return;
            }
        }

        $notFound();
        return;
    }
}
