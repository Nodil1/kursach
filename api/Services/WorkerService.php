<?php
namespace Api\Services;

use Api\Models\DepartmentModel;
use Api\Models\SafeModel;
use Api\Models\UserModel;
use Api\Models\WorkerModel;

final class WorkerService
{
    public static function newWorker(int $idDepartment, int $idUser): WorkerModel
    {
        $newWorker               = new WorkerModel();
        $newWorker->id       = $idUser;
        $newWorker->idDepartment = $idDepartment;
        $newWorker->save();
        return $newWorker;
    }

    public static function getAllowedSafes(int $idWorker): array
    {
        return WorkerModel::getById($idWorker)->department()->safes();
    }

    public static function isWorkerInDepartment(int $idWorker, int $idDepartment): bool
    {
        $workerModel = WorkerModel::getById($idWorker);
        return $workerModel->idDepartment === $idDepartment;
    }

    public static function changeDepartment(int $newIdDepartment, int $idWorker): void
    {
        $worker               = WorkerModel::getById($idWorker);
        $worker->idDepartment = $newIdDepartment;
        $worker->update();
    }

    public static function deleteWorker(int $idWorker){
        $model = WorkerModel::getById($idWorker);
        $user = $model->user();
        $user->isActive = 0;
        $user->update();
    }
}
