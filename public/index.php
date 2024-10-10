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
$router->add('/people/:id', 'PUT', PeopleController::class, 'update');
$router->add('/people/:id', 'DELETE', PeopleController::class, 'destroy');

$router->add('/people/:person_id/contacts', 'GET', ContactsController::class, 'index');
$router->add('/people/:person_id/contacts/new', 'GET', ContactsController::class, 'new');
$router->add('/people/:person_id/contacts', 'POST', ContactsController::class, 'create');
$router->add('/contacts/:id/edit', 'GET', ContactsController::class, 'edit');
$router->add('/contacts/:id', 'PUT', ContactsController::class, 'update');

$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($_POST['_method']) && $_POST['_method']) {
    $requestMethod = $_POST['_method'];
}

$router->dispatch($_SERVER['REQUEST_URI'], $requestMethod);
