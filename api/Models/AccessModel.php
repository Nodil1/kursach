<?php


namespace Api\Models;


use Api\Core\Model;

final class AccessModel extends Model
{
    public int $idClient;
    public int $idSafe;
    public int $type;
    public \DateTime $fromTime;
    public \DateTime $expireTime;

    public function client(): ClientModel
    {
        return ClientModel::getById($this->idClient);
    }

    public function safe(): SafeModel
    {
        return SafeModel::getById($this->idSafe);
    }
}
