<?php

namespace Api\Controllers;

use Api\Core\Controller;
use Api\Core\Request;
use Api\Core\Response;
use Api\Exceptions\ForbiddenMethodException;
use Api\Helpers\Auth;
use Api\Services\DepartmentService;

final class DepartmentController extends Controller
{
    protected function onGet(Request $request): Response
    {
        return (new Response())->createSuccessResponse(DepartmentService::getAll());
    }

    protected function onPost(Request $request): Response
    {

        $name = $request->getParam("addressName");
        return (new Response())->createSuccessResponse([
            "idNew" => DepartmentService::createDepartment($name)
        ]);
    }

    protected function onPut(Request $request): Response
    {
        if (!Auth::isUserType(ROLE_ADMIN)) {
            throw new ForbiddenMethodException();
        }
        DepartmentService::updateDepartment(
            (int)$request->getParam("idDepartment"),
            $request->getParam("addressName"),
        );
        return (new Response())->createSuccessResponse([]);
    }

    protected function onDelete(Request $request): Response
    {
        if (!Auth::isUserType(ROLE_ADMIN)) {
            throw new ForbiddenMethodException();
        }

        DepartmentService::deleteDepartment((int)$request->getParam("idDepartment"));
        return (new Response())->createSuccessResponse([]);
    }
}
