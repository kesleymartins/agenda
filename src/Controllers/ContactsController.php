<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

class ContactsController
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/contacts/index.php';
    }
}
