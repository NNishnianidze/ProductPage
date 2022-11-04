<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;
use DI\Container;
use Twig\Environment as Twig;

class Router
{
    private array $routes = [];

    public function __construct(private Twig $twig, private Container $container)
    {
    }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        //Check if requested Uri is js
        $file = explode('/', $requestUri);

        if (isset($file[1])) {
            if ($file[1] === 'js') {
                return readfile('../resources' . $requestUri);
            }
        }

        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            return $this->twig->render('404.php');
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $class = $this->container->get($class);

            if (method_exists($class, $method)) {
                return call_user_func_array([$class, $method], [$this->twig]);
            }
        }

        return $this->twig->render('404.php');
        //throw new RouteNotFoundException();
    }
}
