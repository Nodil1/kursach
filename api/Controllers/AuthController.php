<?php

namespace Api\Controllers;

use Api\Core\Controller;
use Api\Core\Request;
use Api\Core\Response;
use Api\Exceptions\ForbiddenMethodException;
use Api\Helpers\Auth;

final class AuthController extends Controller
{
    protected function onGet(Request $request): Response
    {
        return (new Response())->createSuccessResponse(
            [
                "idUser" => Auth::login(
                    $request->getParam("login"),
                    $request->getParam("password")
                )
            ]
        );

    }

    protected function onPost(Request $request): Response
    {
        $type = (int)$request->getParam("type");

        return (new Response())->createSuccessResponse(
            [
                "newUser" => Auth::register(
                    $request->getParam("login"),
                    $request->getParam("password"),
                    $type,
                    $request->getParam("name")
                )
            ]
        );
    }

    protected function onPut(Request $request): Response
    {
        throw new ForbiddenMethodException();
    }

    protected function onDelete(Request $request): Response
    {
        throw new ForbiddenMethodException();
    }
}
