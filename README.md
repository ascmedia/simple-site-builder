## Installation
```
$ composer require ascmedia/simple-site-builder
```

## Usage
```php
<?php

namespace TestApp;

use Exception;

class App; 
{
    private const PAGE_DIRECTORY = './pages/';

    private App $app;

    public function __construct() {
        $this->app = App::getInstance();
    }

    public function start(): void
    {
        $routesMap = [
            ['method' => 'GET', 'route' => [''], 'function' => function() {
                $this->app->renderPage(self::PAGE_DIRECTORY, 'home.php', 'template.php');
            }],
            ['method' => 'GET', 'route' => ['policy'], 'function' => function() {
                $this->app->renderPage(self::PAGE_DIRECTORY, 'policy.php', 'template.php');
            }],
            ['method' => 'GET', 'route' => ['thanks'], 'function' => function() {
                $this->app->renderPage(self::PAGE_DIRECTORY, 'thanks.php', 'template.php');
            }],
        ];

        $notFound = function() {
            http_response_code(404);
            $this->app->renderPage(self::PAGE_DIRECTORY, '404.php', 'template.php');
            die();
        };

        $error = function(Exception $e) {
            http_response_code(500);
            $this->app->renderPage(self::PAGE_DIRECTORY, '404.php', 'template.php');
            die();
        };

        $this->app->run(true, $routesMap, $notFound, $error);
    }
}

```
