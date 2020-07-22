<?php

declare(strict_types=1);

namespace App\Repository;


use App\Config\TableNames;

class QualificationRepository extends AbstractRepository
{

    public static function getTableName(): string
    {
        return TableNames::QUALIFICATION;
    }
}