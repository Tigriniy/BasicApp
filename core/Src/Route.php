<?php

namespace Src;

use Error;

use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\MarkBased;
use FastRoute\Dispatcher\MarkBased as Dispatcher;
use Src\Traits\SingletonTrait;

class Route
{
    //Используем методы трейта
    use SingletonTrait;

    //Свойство для хранения текущего маршрута
    private string $currentRoute = '';
    private $currentHttpMethod;

    //Свойство для префикса для всех маршрутов
    private string $prefix = '';

    //Классы для использования внешнего маршрутизатора
    private RouteCollector $routeCollector;

    //Добавляет маршрут, устанавливает его текущим и возвращает объект
    public static function add($httpMethod, string $route, array $action): self
    {
        self::single()->routeCollector->addRoute($httpMethod, $route, $action);
        self::single()->currentHttpMethod = $httpMethod;
        self::single()->currentRoute = $route;
        return self::single();
    }

    //Добавляет префикс для обозначенных маршрутов
    public static function group(string $prefix, callable $callback): void
    {
        self::single()->routeCollector->addGroup($prefix, $callback);
        Middleware::single()->group($prefix, $callback);
    }

    //Конструктор скрыт. Вызывается только один раз
    private function __construct()
    {
        $this->routeCollector = new RouteCollector(new Std(), new MarkBased());
    }

    public function setPrefix(string $value = ''): self
    {
        $this->prefix = $value;
        return $this;
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $this->getUrl($url));
    }

    public function getUrl(string $url): string
    {
        $url = trim($url, '/');

        $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

        return $basePath . '/' . $url;
    }

    //Добавление middlewares для текущего маршрута
    public function middleware(...$middlewares): self
    {
        Middleware::single()->add($this->currentHttpMethod, $this->currentRoute, $middlewares);
        return $this;
    }

    public function start(): void
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        if (!empty($this->prefix) && strpos($uri, $this->prefix) === 0) {
            $uri = substr($uri, strlen($this->prefix));
        }

        if (empty($uri)) {
            $uri = '/';
        }

        $dispatcher = new Dispatcher($this->routeCollector->getData());
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new Error("NOT_FOUND: Роутер искал путь '$uri', но не нашел его.");
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new Error('METHOD_NOT_ALLOWED');
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = array_values($routeInfo[2]);

                //Вызываем обработку всех Middleware
                $vars[] = Middleware::single()->go($httpMethod, $uri, new Request());

                $class = $handler[0];
                $action = $handler[1];

                call_user_func([new $class, $action], ...$vars);
                break;
        }
    }

}