<?php

namespace Providers;

use Src\Provider\AbstractProvider;
use Src\Route;

class RouteProvider extends AbstractProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $rootPath = $this->app->settings->getRootPath();
        Route::single()->setPrefix($rootPath);

        $this->app->bind('route', Route::single());

        $routesDir = __DIR__ . '/../../routes';

        if ($this->checkPrefix('/api')) {
            $this->app->settings->removeAppMiddleware('csrf');
            $this->app->settings->removeAppMiddleware('specialChars');

            $apiPath = $routesDir . '/api.php';
            if (file_exists($apiPath)) {
                require_once $apiPath;
            }
            return;
        }

        $webPath = $routesDir . '/web.php';
        if (file_exists($webPath)) {
            require_once $webPath;
        }
    }

    private function checkPrefix(string $prefix): bool
    {
        $uri = $_SERVER['REQUEST_URI'];
        $rootPath = $this->app->settings->getRootPath();
        if ($rootPath && strpos($uri, $rootPath) === 0) {
            $uri = substr($uri, strlen($rootPath));
        }
        return strpos($uri, $prefix) === 0;
    }

    private function getUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'];
        $rootPath = $this->app->settings->getRootPath();
        if ($rootPath && strpos($uri, $rootPath) === 0) {
            $uri = substr($uri, strlen($rootPath));
        }
        return $uri;
    }

}