<?php


namespace App\Repository;

use App\Config\TableNames;
use DI\Annotation\Injectable;

/**
 * Class PositionRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class PositionRepository extends AbstractRepository
{

    final static function getTableName(): string
    {
        return TableNames::POSITION;
    }
}