<?php declare(strict_types=1);

use App\Agenda\Controllers\ContactsController;
use App\Agenda\Controllers\PeopleController;
use App\Agenda\Core\Router;

require_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../bootstrap.php';

$router = new Router($entityManager);

$router->add('/contacts', ContactsController::class, 'index');
$router->add('/users', PeopleController::class, 'index');
$router->add('/', PeopleController::class, 'index');

$router->dispatch($_SERVER['REQUEST_URI']);
