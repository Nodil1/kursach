<?php
namespace Api\Controllers;

use Api\Core\Controller;
use Api\Core\Request;
use Api\Core\Response;
use Api\Exceptions\ForbiddenMethodException;
use Api\Helpers\Auth;
use Api\Services\DepartmentService;
use Api\Services\WorkerService;
use const ROLE_WORKER;

final class WorkerController extends Controller
{


    protected function onGet(Request $request): Response
    {
        if (!Auth::isUserType(ROLE_ADMIN)) {
            throw new ForbiddenMethodException();
        }
        $idDepartment = $request->getParam("idDepartment");
        return (new Response())->createSuccessResponse(
            DepartmentService::getAllWorkersOfDepartment($idDepartment)
        );

    }


    protected function onPost(Request $request): Response
    {
        if (!Auth::isUserType(ROLE_ADMIN)) {
            throw new ForbiddenMethodException();
        }
        $user = Auth::register(
            $request->getParam("login"),
            $request->getParam("password"),
            ROLE_WORKER,
            $request->getParam("fio")
        );

        return (new Response())->createSuccessResponse([
            "idWorker" => WorkerService::newWorker(
                (int)$request->getParam("idDepartment"),
                $user->id
            )->id
        ]);
    }


    protected function onPut(Request $request): Response
    {
        WorkerService::changeDepartment(
            (int)$request->getParam("newIdDepartment"),
            (int)$request->getParam("idWorker")
        );
        return Response::emptySuccessResponse();
    }

    protected function onDelete(Request $request): Response
    {
        if (!Auth::isUserType(ROLE_ADMIN)) {
            throw new ForbiddenMethodException();
        }
        WorkerService::deleteWorker($request->getParam("idWorker"));
        return Response::emptySuccessResponse();
    }
}
