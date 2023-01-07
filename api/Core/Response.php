<?php

namespace Api\Core;


use Api\Exceptions\MainException;
use JsonException;

final class Response
{
    public string $response;

    public function __construct()
    {
        header("Content-type: application/json; charset=utf-8");

    }

    public function createSuccessResponse(array $response): self
    {
        try {
            $this->response = json_encode([
                "status" => "ok",
                "response" => $response,
            ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (JsonException $error) {
            die("Json wrong");
        }
        return $this;
    }

    public function createErrorResponse(MainException $error): self
    {
        http_response_code(400);
        try {
            $this->response = json_encode([
                "status" => "error",
                "response" => $error->getMessage(),
                "debug" => $error->debugMessage,
                "stackTrace" => $error->getTraceAsString(),
            ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (JsonException $error) {
            die("Json wrong");
        }
        return $this;
    }

    public static function emptySuccessResponse(): self
    {
        $response = new self();
        $response->createSuccessResponse([]);
        return $response;
    }
}
