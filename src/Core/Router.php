<?php declare(strict_types=1);

namespace App\Agenda\Core;

use Doctrine\ORM\EntityManagerInterface;

class Router
{
    private array $routes = [];

    public function __construct(private EntityManagerInterface $entityManager) {}

    public function add(string $route, string $controller, string $method): void
    {
        $route = preg_replace('/:[a-z_]+/', '\d+', $route);
        $this->routes[] = [
            'route' => $route,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function dispatch(string $requestedRoute): void
    {
        foreach ($this->routes as $route) {
            $pattern = '@^' . $route['route'] . '$@';

            if (preg_match($pattern, $requestedRoute)) {
                $controller = new $route['controller']($this->entityManager);

                preg_match_all('/\d+/', $requestedRoute, $params);

                call_user_func_array([$controller, $route['method']], ...$params);
                return;
            }
        }

        echo '404 - Página não encontrada';
    }
}
