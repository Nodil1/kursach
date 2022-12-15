<?php
namespace Api\Services;

use Api\Exceptions\NotFoundException;
use Api\Models\KeyModel;
use Api\Models\SafeModel;


final class KeyService
{
    public static function createKey(int $idSafe): KeyModel
    {
        if ((new SafeModel())->where("id", $idSafe)->isEmpty()) {
            throw new NotFoundException("Сейф не найден", "Safe $idSafe");
        }

        $key           = new KeyModel();
        $key->idSafe   = $idSafe;
        $key->isInBank = 1;
        $key->save();
        return $key;
    }

    public static function issueKey(int $idKey): void
    {
        $key = KeyModel::getById($idKey);
        $key->isInBank = 0;
        $key->update();
    }

    public static function returnKeyToBank(int $idKey): void
    {
        $key = KeyModel::getById($idKey);
        $key->isInBank = 1;
        $key->update();
    }
}
