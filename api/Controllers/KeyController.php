<?php


namespace Api\Controllers;


use Api\Core\Controller;
use Api\Core\Request;
use Api\Core\Response;
use Api\Helpers\Auth;
use Api\Services\ClientService;
use Api\Services\KeyService;

class KeyController extends Controller
{

    protected function onGet(Request $request): Response
    {
        return (new Response())->createSuccessResponse(
            KeyService::getKeys($request->getParam("idSafe"))
        );
    }

    protected function onPost(Request $request): Response
    {
        KeyService::createKey($request->getParam("idSafe"));

        return (new Response())->createSuccessResponse([]
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