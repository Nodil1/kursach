<?php

namespace Api\Controllers;

use Api\Core\Controller;
use Api\Core\Request;
use Api\Core\Response;
use Api\Exceptions\ForbiddenMethodException;
use Api\Helpers\Auth;
use Api\Services\ClientService;
use Api\Services\SafeService;
use Api\Services\WorkerService;

final class SafeController extends Controller
{

    protected function onGet(Request $request): Response
    {

        if (Auth::isUserType(ROLE_WORKER)) {
            return (new Response())->createSuccessResponse(
                WorkerService::getAllowedSafes(Auth::getCurrentUser()->worker()->id)
            );
        }

        if (Auth::isUserType(ROLE_CLIENT)) {
            return (new Response())->createSuccessResponse(
                ClientService::getClientSafes(Auth::getCurrentUser()->client()->id)
            );
        }


        throw new ForbiddenMethodException();
    }


    protected function onPost(Request $request): Response
    {
        if (Auth::isUserType(ROLE_WORKER)) {
            $price = (int)$request->getParam("price");
            return (new Response())->createSuccessResponse([
                    "idNew" => SafeService::createSafe(
                        Auth::getCurrentUser()->worker()->idDepartment,
                        Auth::getCurrentUser()->worker()->id,
                        $price
                    )->id
                ]
            );
        }

        if (Auth::isUserType(ROLE_CLIENT)) {
            $idSafe = $request->getParam("idSafe");
            SafeService::rentSafe($idSafe, Auth::getCurrentUser()->client()->id);
            return (new Response())->createSuccessResponse([]);
        }
        throw new ForbiddenMethodException();
    }

    protected function onPut(Request $request): Response
    {
        throw new ForbiddenMethodException();
    }

    protected function onDelete(Request $request): Response
    {
        if (Auth::isUserType(ROLE_WORKER)) {
            $idSafe = (int)$request->getParam("idSafe");
            SafeService::deleteSafe($idSafe, Auth::getCurrentUser()->worker()->id);
            return (new Response())->createSuccessResponse([
                    "deleteId" => $idSafe
                ]
            );
        }

        if (Auth::isUserType(ROLE_CLIENT)) {
            $idSafe = (int)$request->getParam("idSafe");
            SafeService::unRentSafe($idSafe, Auth::getCurrentUser()->client()->id);
        }
    }
}
