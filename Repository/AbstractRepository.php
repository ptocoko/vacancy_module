<?php


namespace App\Repository;


use App\Dbo\Dbo;
use Exception;

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
        $stmt = $this->dbo->query("SELECT * FROM " . $this::getTableName());
        return $stmt->fetchAll();
    }

    abstract protected static function getTableName(): string;

    public function delete(?string $id)
    {
        $this->dbo->beginTransaction();
        try {
            $stmt = $this->dbo->prepare("DELETE  from " . $this::getTableName() . " WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $this->dbo->commit();
        } catch (Exception $exception) {
            echo $exception->getMessage();
            $this->dbo->rollBack();
        }
    }
}
