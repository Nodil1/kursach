<?php

namespace Api\Models;

use Api\Core\Model;


final class UserModel extends Model
{

    protected static string $tableName = "users";
    public string $login;
    public string $password;
    public string $fio;
    public int $type;
    public int $isActive = 1;

    public function worker(): WorkerModel
    {
        return WorkerModel::getById($this->id);
    }

    public function admin(): WorkerModel
    {
        return WorkerModel::getById($this->id);
    }

    public function client(): ClientModel
    {
        return ClientModel::getById($this->id);
    }
}
