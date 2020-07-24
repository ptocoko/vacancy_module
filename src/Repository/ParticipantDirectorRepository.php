<?php

declare(strict_types=1);

namespace App\Repository;

use App\Config\TableNames;
use App\Models\User;
use DI\Annotation\Injectable;

/**
 * Class ParticipantDirectorRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class ParticipantDirectorRepository extends AbstractRepository
{

    public function findById(int $id): ?User
    {
        $stmt = $this->dbo->prepare(sprintf("SELECT * FROM %s WHERE id = :id", $this::getTableName()));
        $stmt->execute([':id' => $id]);
        return $stmt->fetchObject(User::class);
    }

    final static function getTableName(): string
    {
        return TableNames::PARTICIPANT_DIRECTOR;
    }
}