<?php

declare(strict_types=1);

namespace Core\Infrastructure;

use JsonSerializable;

class ActionPayload implements JsonSerializable
{
    private int $statusCode;
    private $data;
    private $error;
    public function __construct(int $statusCode = 200, $data = null, $error = null)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->error = $error;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return mixed|null
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return mixed|null
     */
    public function getError(): mixed
    {
        return $this->error;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        $payload = [
            'status' => $this->getStatusCode()
        ];
        if ($this->getData() !== null) {
            $payload['data'] = $this->getData();
        } else {
            $payload['error'] = $this->getError();
        }
        return $payload;
    }
}
