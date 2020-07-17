<?php


namespace App\Repository;

use DI\Annotation\Injectable;

/**
 * Class AreaRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class AreaRepository extends AbstractRepository
{

    public function findAll()
    {
        $stmt = $this->dbo->prepare("SELECT * FROM " . $this::getTableName() . " WHERE Actualcode = :acode");
        $stmt->execute([':acode' => '']);
        return $stmt->fetchAll();
    }

    final static function getTableName(): string
    {
        return 'Areas';
    }

    public function findByCode($code)
    {
        $stmt = $this->dbo->prepare("SELECT * FROM " . $this::getTableName() . " WHERE Code= :code");
        $stmt->execute([':code' => $code]);
        return $stmt->fetchAll();
    }
}
