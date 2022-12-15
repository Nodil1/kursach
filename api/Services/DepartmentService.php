<?php
namespace Api\Services;

use Api\Models\DepartmentModel;

final class DepartmentService
{
    public static function createDepartment(string $name): int
    {
        $newDepartment          = new DepartmentModel();
        $newDepartment->address = $name;
        $newDepartment->save();
        return $newDepartment->id;
    }

    public static function deleteDepartment(int $idDepartment): void
    {
        foreach (DepartmentModel::getById($idDepartment)->workers() as $worker) {
            $worker->delete();
        }
        DepartmentModel::getById($idDepartment)->delete();
    }

    public static function updateDepartment(int $idDepartment, string $newName): void
    {
        $model          = DepartmentModel::getById($idDepartment);
        $model->address = $newName;
        $model->update();
    }

    public static function getAll(): array
    {
        return DepartmentModel::getAll();
    }

    public static function getFreeSafes(int $idDepartment): array
    {
        $safes = DepartmentModel::getById($idDepartment)->safes();
        $result = [];
        foreach ($safes as $safe) {
            if ($safe->idOwner === null) {
                $result[] = $safes;
            }
        }
        return $result;
    }

    public static function getAllWorkersOfDepartment(int $idDepartment): array
    {
        return DepartmentModel::getById($idDepartment)->workers();
    }

    public static function getAllSafes(int $idDepartment): array
    {
        return DepartmentModel::getById($idDepartment)->safes();
    }
}
