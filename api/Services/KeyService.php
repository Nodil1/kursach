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

        $key = new KeyModel();
        $key->idSafe = $idSafe;
        $key->isInBank = 1;
        $key->save();
        return $key;
    }

    public static function getKeys(int $idSafe): array
    {
        return SafeModel::getById($idSafe)->keys();
    }

    public static function issueKey(int $idKey): void
    {
        $model = new KeyModel();
        $model->idSafe = 0;
        $model->isInBank = 0;
        $model->save();
        $model->where("id_safe", "123")->orderBy("ASK")->get();
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

    public static function changeState(int $idKey): void
    {
        $key = KeyModel::getById($idKey);
        if ($key->isInBank === 0) {
            $key->isInBank = 1;
        } else {
            $key->isInBank = 0;
        }
        $key->update();
    }

    public static function deleteKey(int $idKey)
    {
        $key = KeyModel::getById($idKey);
        $key->delete();
    }

}
