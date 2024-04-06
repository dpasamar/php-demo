<?php
declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

return [
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
    },
    Logger::class => function (ContainerInterface $container) {
        $logger = new Logger('app_logs');
        $formatter = new LineFormatter(LOG_FORMAT, LOG_DATE_FORMAT);
        $stream = new StreamHandler(LOCAL_LOGGER_FILE_NAME);
        $stream->setFormatter($formatter);
        $logger->pushHandler($stream);
        return $logger;
    }
];