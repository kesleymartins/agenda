<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

use Twig\Environment;

class AbstractController
{
    protected Environment $twig;

    public function __construct()
    {
        $class_path = explode('\\', get_class($this));
        $class = end($class_path);
        $controller = str_replace('Controller', '', $class);

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Views/' . strtolower($controller) . '/');
        $this->twig = new \Twig\Environment($loader, []);
    }
}
