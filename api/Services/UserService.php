<?php
namespace Api\Services;

use Api\Exceptions\WrongUserTypeException;
use Api\Helpers\Auth;
use Api\Models\UserModel;
use const Api\Models\ROLE_ADMIN;
use const Api\Models\ROLE_CLIENT;
use const Api\Models\ROLE_WORKER;

final class UserService
{
    public static function isUserType(int $type, int $idUser): bool
    {
        return UserModel::getById($idUser)->type === $type;
    }

    public static function isUserWorkerIfNotThrowException(int $idUser): void
    {
        if (self::isUserType(ROLE_WORKER, $idUser)) {
            throw new WrongUserTypeException("Вы не работник банка!", "User type ".${Auth::getCurrentUser()});
        }
    }

    public static function isUserClientIfNotThrowException(int $idUser): void
    {
        if (self::isUserType(ROLE_CLIENT, $idUser)) {
            throw new WrongUserTypeException("Вы не клиент банка!", "User type ".${Auth::getCurrentUser()->type});
        }
    }

    public static function isUserAdminIfNotThrowException(int $idUser): void
    {
        if (self::isUserType(ROLE_ADMIN, $idUser)) {
            throw new WrongUserTypeException("Вы не админ банка!", "User type ".${Auth::getCurrentUser()->type});
        }
    }
}
