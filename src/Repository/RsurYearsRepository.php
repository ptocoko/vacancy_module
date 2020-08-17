<?php


namespace App\Repository;


use App\Config\TableNames;

class RsurYearsRepository extends AbstractRepository
{

    public static function getTableName(): string
    {
        return TableNames::RSUR['years'];
    }


}