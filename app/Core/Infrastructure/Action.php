<?php

declare(strict_types=1);

namespace Core\Infrastructure;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

abstract class Action
{
    protected Request $request;
    protected Response $response;
    protected array $args;
    public function __construct()
    {
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        return $this->action();
    }

    abstract protected function action(): Response;
    protected function getFormData(): ?array
    {
        return $this->request->getParsedBody();
    }

    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, sprintf("<%s> Attribute Not Found!", $name));
        }
        return $this->args[$name];
    }

    protected function respondWithData(array $data, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);
        return $this->respond($payload);
    }

    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $this->response->getBody()->write($json);
        return $this->response;
    }

    protected function redirect(string $url, array $params = [], int $statusCode = 302): Response
    {
        $tokenParser = RouteContext::fromRequest($this->request)->getRouteParser();
        $to = $tokenParser->urlFor($url, $params);
        return $this->response->withHeader('Location', $to)->withStatus($statusCode);
    }
}
