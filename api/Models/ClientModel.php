<?php
namespace Api\Models;

use Api\Core\Model;

final class ClientModel extends Model
{

    protected static string $tableName = "clients";
    public int $idUser;
    public int $passport;
    public int $balance;

    public function accesses(): array
    {
        return (new AccessModel())->where("id_client", $this->id)->get();
    }

    public function safes(): array
    {
        return (new SafeModel())->where("id_owner", $this->id)->get();
    }
}
