<?php
namespace Api\Models;

use Api\Core\Model;

final class DepartmentModel extends Model
{
    protected static string $tableName = "departments";
    public string $address;

    public function workers(): array
    {
        return (new WorkerModel())
            ->where("id_department", $this->id)
            ->whereIn("id", "SELECT users.id FROM users WHERE users.is_active = 1", false)
            ->get();
    }

    public function safes(): array
    {
        return (new SafeModel())->where("id_department", $this->id)->get();
    }

}
