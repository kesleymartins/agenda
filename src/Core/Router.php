<?php declare(strict_types=1);

namespace App\Agenda\Core;

use Doctrine\ORM\EntityManagerInterface;

class Router
{
    private array $routes = [];

    public function __construct(private EntityManagerInterface $entityManager) {}

    public function add(string $route, string $action, string $controller, string $method): void
    {
        $route = preg_replace('/:[a-z_]+/', '\d+', $route);
        $this->routes[] = [
            'route' => $route,
            'action' => $action,
            'controller' => $controller,
            'method' => strtoupper($method),
        ];
    }

    public function dispatch(string $requestedRoute, string $action): void
    {
        foreach ($this->routes as $route) {
            $pattern = '@^' . $route['route'] . '$@';

            $requestedRoute = $this->removeGetParams($requestedRoute);

            if (preg_match($pattern, $requestedRoute) && $route['action'] === $action) {
                $controller = new $route['controller']($this->entityManager);

                preg_match_all('/\d+/', $requestedRoute, $params);

                call_user_func_array([$controller, $route['method']], ...$params);
                return;
            }
        }

        echo '404 - Página não encontrada';
    }

    private function removeGetParams(string $route): string
    {
        $route = preg_replace('/\/\?[a-zA-Z0-9=&]+/', '', $route);

        if (empty($route)) {
            $route = '/';
        }

        return $route;
    }
}
