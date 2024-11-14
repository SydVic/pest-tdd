<?php

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

# parameters
$dsn = $_ENV['DSN'];
$container->add('dsn', new \League\Container\Argument\Literal\StringArgument($dsn));

$migrationsFolder = dirname(__DIR__) . '/migrations';
$container->add(
    'migrations_folder',
    new \League\Container\Argument\Literal\StringArgument($migrationsFolder)
);

$routes = include __DIR__ . '/routes.php';

#services
$container->add(\App\Routing\RouteHandlerResolver::class)
    ->addArguments([$container]);

$container->add(\App\Routing\Router::class)
    ->addArguments([\App\Routing\RouteHandlerResolver::class]);
$container->extend(\App\Routing\Router::class)
    ->addMethodCall('setRoutes', [$routes]);

$container->add(\App\Http\Kernel::class)
    ->addArguments([\App\Routing\Router::class]);

// shared means that once is resolved the first time if another class require it will be used the same object
$container->addShared(\App\Database\Connection::class)
    ->addArguments(['dsn']);

return $container;