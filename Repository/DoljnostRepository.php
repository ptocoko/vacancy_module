<?php


namespace App\Repository;

use DI\Annotation\Injectable;

/**
 * Class DoljnostRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class DoljnostRepository extends AbstractRepository
{

    final static function getTableName(): string
    {
        return 'doljnost';
    }
}