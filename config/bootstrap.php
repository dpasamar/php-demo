<?php
use DI\ContainerBuilder;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/config.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

$container = $containerBuilder->build();

$app = $container->get(App::class);

(require __DIR__ . '/routes.php')($app);
(require __DIR__ . '/middleware.php')($app);

return $app;