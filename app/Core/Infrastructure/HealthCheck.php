<?php

namespace Core\Infrastructure;

use Psr\Http\Message\ResponseInterface as Response;

final class HealthCheck extends Action
{

    protected function action(): Response
    {
        return $this->respondWithData([
            'status' => "OK",
        ]);
    }
}