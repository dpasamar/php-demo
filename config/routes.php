<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', function ($request, $response, $args) {
        $response->getBody()->write('OK!');
        return $response;
    })->setName('healt');
};