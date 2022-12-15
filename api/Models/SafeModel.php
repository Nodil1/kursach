<?php
namespace Api\Models;

use Api\Core\Model;

final class SafeModel extends Model
{
    protected static string $tableName = "safes";
    public ?string $idOwner;
    public string $idDepartment;
    public int $price;

    public function keys(): array
    {
        return (new KeyModel())->where("id_safe", $this->id)->get();
    }

    public function accesses(): array
    {
        return (new AccessModel())->where("id_safe", $this->id)->get();
    }
}
