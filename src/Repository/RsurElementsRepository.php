<?php


namespace App\Repository;


use App\Config\TableNames;

class RsurElementsRepository extends AbstractRepository
{
    protected $isSoftDelete = true;

    public static function getTableName(): string
    {
        return TableNames::RSUR['elements'];
    }

}