<?php

declare(strict_types=1);

namespace App\Repository;

use App\Config\TableNames;
use DI\Annotation\Injectable;

/**
 * Class AreaRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class AreaRepository extends AbstractRepository
{

    public function findAll(): array
    {
        $stmt = $this->dbo->query("SELECT * FROM {$this::getTableName()} WHERE Actualcode = ''");
        return $stmt->fetchAll();
    }

    final static function getTableName(): string
    {
        return TableNames::AREA;
    }

    public function findByCode(int $code): array
    {
        $stmt = $this->dbo->prepare(sprintf("SELECT * FROM %s WHERE Code= :code", $this::getTableName()));
        $stmt->execute([':code' => $code]);
        return $stmt->fetchAll();
    }
}
