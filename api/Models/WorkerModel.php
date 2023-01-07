<?php

namespace Api\Models;

use Api\Core\Model;

final class WorkerModel extends Model
{
    protected static string $tableName = "workers";
    public int $idDepartment;

    public function fillInfo(): self
    {
        $this->fio = $this->user()->fio;
        $this->login = $this->user()->login;
        return $this;
    }

    public function user(): UserModel
    {
        return UserModel::getById($this->id);
    }

    public function department(): DepartmentModel
    {
        return DepartmentModel::getById($this->idDepartment);
    }
}
