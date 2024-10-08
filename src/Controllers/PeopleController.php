<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

class PeopleController
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/people/index.php';
    }
}
