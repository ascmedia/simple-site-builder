<?php

namespace ASCMedia\SimpleSiteBuilder;

class App
{
    private static $instance = null;
    private bool $isDev = false;
    private Request $request;

    public static function getInstance(): App
    {
        if (is_null(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function run(bool $isDev, $routes, $notFound, $error): void
    {
        $this->isDev = $isDev;
        if ($this->isDev) {
            ini_set('display_errors', 1);
        } else {
            ini_set('display_errors', 0);
        }

        session_start();
        $this->request = new Request();
        $this->setUtmSession();

        $router = new Router;
        $router->map($routes, $notFound, $error);
    }

    public function renderPage(string $pagesDirectory, string $page, ?string $template = null): void
    {
        if ($template) {
            include_once $pagesDirectory.$template;
        } else {
            include $pagesDirectory.$page;
        }
    }

    public function localRedirect(string $url): void
    {
        header('Location:' . $url);
        die;
    }

    public function getFileChangedTimeStamp(string $path): int
    {
        return $path.'?v='.filemtime('.'.$path);
    }

    private function setUtmSession(): void
    {
        $this->checkUtm('utm_source');
        $this->checkUtm('utm_medium');
        $this->checkUtm('utm_campaign');
        $this->checkUtm('utm_content');
        $this->checkUtm('utm_term');
    }

    private function checkUtm(string $utm): void
    {
        if ($this->request->get($utm)) {
            $_SESSION[$utm] = $this->request->get($utm);
        }
    }
}    
