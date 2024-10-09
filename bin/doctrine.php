<?php declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../src/Entities/'],
    isDevMode: true,
);

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

$connectionParams = [
    'driver' => 'pdo_pgsql',
    'host' => $_ENV['POSTGRES_HOST'],
    'dbname' => $_ENV['POSTGRES_DB'],
    'user' => $_ENV['POSTGRES_USER'],
    'password' => $_ENV['POSTGRES_PASSWORD'],
];

$connection = DriverManager::getConnection($connectionParams, $config);
$entityManager = new EntityManager($connection, $config);

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
