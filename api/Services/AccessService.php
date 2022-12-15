<?php


namespace Api\Services;


use Api\Exceptions\PermissionDeniedException;
use Api\Models\AccessModel;
use Api\Models\SafeModel;

final class AccessService
{
    public static function issueAccess(int $idSafe, int $idSafeOwner, int $idClient): int
    {
        $safeModel = SafeModel::getById($idSafe);
        if ($safeModel->idOwner !== $idSafeOwner) {
            throw new PermissionDeniedException("SafeOwner $safeModel->idOwner, Passed value $idSafeOwner");
        }

        $newAccess = new AccessModel();
        $newAccess->idSafe = $idSafe;
        $newAccess->idClient = $idClient;
        $newAccess->save();
        return $newAccess->id;
    }
}
