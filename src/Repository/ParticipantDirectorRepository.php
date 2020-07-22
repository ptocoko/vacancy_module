<?php

declare(strict_types=1);

namespace App\Repository;

use App\Config\TableNames;
use DI\Annotation\Injectable;

/**
 * Class ParticipantDirectorRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class ParticipantDirectorRepository extends AbstractRepository
{

    public function findById(int $id): array
    {
        $stmt = $this->dbo->prepare(sprintf("SELECT * FROM %s WHERE id = :id", $this::getTableName()));
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll();
    }

    final static function getTableName(): string
    {
        return TableNames::PARTICIPANT_DIRECTOR;
    }
}