<?php
namespace Api\Models;

use Api\Core\Model;

final class DepartmentModel extends Model
{
    protected static string $tableName = "departments";
    public string $address;

    public function workers(): array
    {
        return (new WorkerModel())->where("id_department", $this->id)->get();
    }

    public function safes(): array
    {
        return (new SafeModel())->where("id_department", $this->id)->get();
    }

}
