<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    // Parse JSON form data and XML
    $app->addBodyParsingMiddleware();
    // Slim Routing
    $app->addRoutingMiddleware();
    // Handle Exceptions
    $app->addErrorMiddleware(true, true, true);
};