<?php declare(strict_types=1);

namespace App\Agenda\Core;

class Router
{
    private array $routes = [];

    public function add(string $route, string $controller, string $method): void
    {
        $this->routes[] = [
            'route' => $route,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function dispatch(string $requestedRoute): void
    {
        foreach ($this->routes as $route) {
            if ($route['route'] === $requestedRoute) {
                $controller = new $route['controller'];
                call_user_func([$controller, $route['method']]);
                return;
            }
        }

        echo '404 - Página não encontrada';
    }
}
