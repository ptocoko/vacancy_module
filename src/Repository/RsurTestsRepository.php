<?php


namespace App\Repository;


use App\Config\TableNames;

class RsurTestsRepository extends AbstractRepository
{

    final public static function getTableName(): string
    {
        return TableNames::RSUR['tests'];
    }

}