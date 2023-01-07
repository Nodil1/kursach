<?php


namespace Api\Controllers;


use Api\Core\Controller;
use Api\Core\Request;
use Api\Core\Response;
use Api\Exceptions\ForbiddenMethodException;
use Api\Helpers\Auth;
use Api\Services\ClientService;
use Api\Services\DepartmentService;
use Api\Services\KeyService;

class ClientController extends Controller
{

    protected function onGet(Request $request): Response
    {

    }

    protected function onPost(Request $request): Response
    {
        if (!Auth::isUserType(ROLE_WORKER)) {
            throw new ForbiddenMethodException();
        }
        $user = Auth::register(
            $request->getParam("login"),
            $request->getParam("password"),
            ROLE_CLIENT,
            $request->getParam("fio")
        );
        return (new Response())->createSuccessResponse(
            [
                ClientService::newClient(
                    $user->id,
                    $request->getParam("passport")
                )
            ]
        );
    }

    protected function onPut(Request $request): Response
    {
        // TODO: Implement onPut() method.
    }

    protected function onDelete(Request $request): Response
    {
        // TODO: Implement onDelete() method.
    }
}