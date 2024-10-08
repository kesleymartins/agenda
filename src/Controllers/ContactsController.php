<?php declare(strict_types=1);

namespace App\Agenda\Controllers;

class ContactsController extends AbstractController
{
    public function index(): void
    {
        echo $this->twig->render('index.twig', []);
    }
}
