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

        if (str_contains($routes[0], '?')) {
            $routes[0] = explode('?', $routes[0])[0];
        }

        foreach ($routesMap as $routeMap) {
            if ($routes[0] === $routeMap['route']) {
                if ($request->server('REQUEST_METHOD') === $routeMap['method']) {
                    try {
                        $routeMap['function']();
                    } catch (Exception $e) {
                        $error($e);
                    }
                    return;
                }
            }
        }

        $notFound();
        return;
    }
}

