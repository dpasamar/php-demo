<?php
declare(strict_types=1);

use Slim\App;
use Core\Infrastructure\HealthCheck;

return function (App $app) {
    $app->get('/health', HealthCheck::class)->setName('healt');
};