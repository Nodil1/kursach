<?php

namespace Api\Core;

use Api\Exceptions\ForbiddenMethodException;
use Api\Exceptions\MainException;

abstract class Controller
{
    final public function run(): Response
    {
        try {
            $request = new Request();
            return match ($request->type) {
                "GET" => $this->onGet($request),
                "POST" => $this->onPost($request),
                "PUT" => $this->onPut($request),
                "DELETE" => $this->onDelete($request),
                default => throw new ForbiddenMethodException("Unknown method: {$_SERVER['HTTP_X_HTTP_METHOD']}"),
            };
        } catch (MainException $error) {
            $response = new Response();
            $response->createErrorResponse($error);
            return $response;
        }

    }

    abstract protected function onGet(Request $request): Response;

    abstract protected function onPost(Request $request): Response;

    abstract protected function onPut(Request $request): Response;

    abstract protected function onDelete(Request $request): Response;
}
