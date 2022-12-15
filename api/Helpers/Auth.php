<?php
namespace Api\Helpers;

use Api\Core\Response;
use Api\Exceptions\MainException;
use Api\Exceptions\NotFoundException;
use Api\Models\UserModel;

final class Auth
{

    public static function isUserAuth(): bool
    {
        return isset($_SESSION['idUser']);
    }

    public static function isUserType(int $idType): bool
    {
        return self::getCurrentUser()->type === $idType;
    }

    public static function isUserExist(string $login): bool
    {
        return !(new UserModel())->where("login", $login)->isEmpty();
    }

    public static function getCurrentUser(): UserModel
    {
        if (!self::isUserAuth()) {
            throw new MainException("Вы не авторизованы!", "");
        }
        return UserModel::getById((int)$_SESSION['idUser']);
    }

    public static function login(string $login, string $password): UserModel
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        try {
            $user = (new UserModel())->where("login", $login)->where("password", $password)->first();
            $_SESSION['idUser'] = $user->id;
            return $user;
        } catch (NotFoundException) {
            throw new MainException("Неправильный логин или пароль", "$login $password");
        }
    }

    public static function register(string $login, string $password, int $type, string $name): UserModel
    {
        if (self::isUserExist($login)) {
            throw new MainException("Пользователь с таким логином уже существует", $login);
        }

        $user = new UserModel();
        $user->fio = $name;
        $user->login = $login;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->type = $type;
        $user->save();
        $_SESSION["idUser"] = $user->id;
        return $user;
    }
}

