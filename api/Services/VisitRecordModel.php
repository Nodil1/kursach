<?php


namespace Api\Services;


use Api\Core\Model;

class VisitRecordModel extends Model
{
    public int $idAccess;
    public string $visitDate;
    public string $recordDate;
}
