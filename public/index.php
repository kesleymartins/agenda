<?php declare(strict_types=1);

use App\Agenda\Controllers\ContactsController;
use App\Agenda\Controllers\PeopleController;
use App\Agenda\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

$router = new Router($entityManager);

$router->add('/', 'GET', PeopleController::class, 'index');
$router->add('/people', 'GET', PeopleController::class, 'index');
$router->add('/people/new', 'GET', PeopleController::class, 'new');
$router->add('/people', 'POST', PeopleController::class, 'create');
$router->add('/people/:id/edit', 'GET', PeopleController::class, 'edit');
$router->add('/people/:id', 'POST', PeopleController::class, 'update');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
