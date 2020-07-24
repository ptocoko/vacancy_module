<?php

declare(strict_types=1);

namespace App\Repository;


use App\Config\Dbo;

abstract class AbstractRepository
{
    /**
     * @var Dbo
     */
    protected $dbo;

    /**
     * @var string
     */
    public function __construct(Dbo $dbo)
    {
        $this->dbo = $dbo;
    }

    public function findAll()
    {
        $stmt = $this->dbo->query('SELECT * FROM ' . static::getTableName());
        return $stmt->fetchAll();
    }

    abstract public static function getTableName(): string;

    public function delete(int $id): int
    {
        $stmt = $this->dbo->prepare(sprintf('DELETE  from %s WHERE id = :id', static::getTableName()));
        $stmt->execute([':id' => $id]);
        return $id;
    }
}
