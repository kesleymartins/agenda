<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

class HomeController
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/home/index.php';
    }
}