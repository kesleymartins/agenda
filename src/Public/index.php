<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Agenda\Controllers\ContactsController;
use App\Agenda\Controllers\HomeController;
use App\Agenda\Controllers\PeopleController;
use App\Agenda\Core\Router;

$router = new Router();

$router->add('/', HomeController::class, 'index');
$router->add('/contacts', ContactsController::class, 'index');
$router->add('/users', PeopleController::class, 'index');

$router->dispatch($_SERVER['REQUEST_URI']);
