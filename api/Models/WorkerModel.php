<?php
namespace Api\Models;

use Api\Core\Model;

final class WorkerModel extends Model
{
    protected static string $tableName = "workers";
    public string $idDepartment;

    public function user(): UserModel
    {
        return UserModel::getById($this->id);
    }

    public function department(): DepartmentModel
    {
        return DepartmentModel::getById($this->id);
    }
}
