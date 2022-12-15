<?php
namespace Api\Models;

use Api\Core\Model;

final class KeyModel extends Model
{
    protected static string $tableName = "keys";
    public int $idSafe;
    public int $isInBank;
}
