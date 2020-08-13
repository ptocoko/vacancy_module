<?php

declare(strict_types=1);

namespace App\Repository;


use App\Core\Dbo;

abstract class AbstractRepository
{
    /**
     * @var Dbo
     */
    protected $dbo;

    protected $primary = 'id';
    /**
     * @var mixed
     */
    protected $result;

    /**
     * @var string
     */
    public function __construct(Dbo $dbo)
    {
        $this->dbo = $dbo;
    }

    public function findAll(): array
    {
        $stmt = $this->dbo->query(sprintf('SELECT * FROM %s', static::getTableName()));
        return $stmt->fetchAll();
    }

    abstract public static function getTableName(): string;

    public function find($primaryValue): array
    {
        $stmt = $this->dbo->prepare(sprintf('SELECT * FROM %s WHERE %s = :id', static::getTableName(), $this->primary));
        $stmt->execute(['id' => $primaryValue]);
        return $stmt->fetch();
    }

    public function delete(int $id): int
    {
        $stmt = $this->dbo->prepare(sprintf('DELETE FROM %s WHERE id = :id', static::getTableName()));
        $stmt->execute([':id' => $id]);
        return $id;
    }
}
