<?php

namespace Api\Services;

use Api\Exceptions\MainException;
use Api\Exceptions\PermissionDeniedException;
use Api\Models\KeyModel;
use Api\Models\SafeModel;
use Api\Models\WorkerModel;

final class SafeService
{
    public static function createSafe(int $idDepartment, int $idWorker): SafeModel
    {
        $workerModel = WorkerModel::getById($idWorker);
        if ($workerModel->idDepartment != $idDepartment) {
            throw new PermissionDeniedException($workerModel->idDepartment." ".$idDepartment);
        }

        $safe               = new SafeModel();
        $safe->idOwner      = null;
        $safe->idDepartment = $idDepartment;
        $safe->save();
        return $safe;
    }

    public static function deleteSafe(int $idSafe, int $idWorker): void
    {
        $safeModel   = SafeModel::getById($idSafe);
        $workerModel = WorkerModel::getById($idWorker);
        if ($safeModel->idDepartment !== $workerModel->idDepartment) {
            throw new PermissionDeniedException("Safe $safeModel->idDepartment Worker $workerModel->idDepartment");
        }

        (new KeyModel())->where("id_safe", $idSafe)->delete();
        $safeModel->delete();
    }

    public static function isSafeFree(int $idSafe): bool
    {
        return SafeModel::getById($idSafe)->idOwner === null;
    }

    public static function rentSafe(int $idSafe, int $idClient): void
    {
        $safe          = SafeModel::getById($idSafe);
        if (!self::isSafeFree($idSafe)) {
            throw new MainException("Сейф не доступен для аренды", "Safe $idSafe, Client $idClient");
        }
        $safe->idOwner = $idClient;
        $safe->update();
    }

    public static function unRentSafe(int $idSafe, int $idClient): void
    {
        $safe        = SafeModel::getById($idSafe);

        if ($idClient !== $safe->idOwner) {
            throw new MainException("Вы не владеете этим сейфом", "Safe $idSafe, Client $idClient");
        }
        $safe->idOwner = null;
        $safe->update();
    }
}
