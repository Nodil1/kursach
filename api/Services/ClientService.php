<?php
namespace Api\Services;

use Api\Models\ClientModel;
use Api\Models\SafeModel;
use Api\Models\UserModel;


final class ClientService
{
    public static function getClientSafes(int $idClient): array
    {
        return ClientModel::getById($idClient)->safes();
    }

    public static function getClientAccesses(int $idClient): array
    {
        return ClientModel::getById($idClient)->accesses();
    }

}
