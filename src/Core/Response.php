<?php declare(strict_types=1);

namespace App\Agenda\Core;

use Twig\Environment;

class Response
{
    private Environment $twig;

    public function __construct(string $klass)
    {
        $class_path = explode('\\', $klass);
        $class = end($class_path);
        $controller = str_replace('Controller', '', $class);

        $loader = new \Twig\Loader\FilesystemLoader();
        $loader->addPath(__DIR__ . '/../Views/templates');
        $loader->addPath(__DIR__ . '/../Views/' . strtolower($controller) . '/');

        $this->twig = new \Twig\Environment($loader);
    }

    public function render(string $page, array $data): void
    {
        $flashMessages = FlashMessage::get();
        $data['flash_messages'] = $flashMessages;

        echo $this->twig->render($page . '.twig', $data);
        exit();
    }

    public function redirect(string $url, int $statusCode = 200): void
    {
        header('Location: ' . $url, true, $statusCode);
        exit();
    }
}
