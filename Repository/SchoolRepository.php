<?php


namespace App\Repository;

use DI\Annotation\Injectable;

/**
 * Class SchoolRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class SchoolRepository extends AbstractRepository
{

	public function findAll()
	{
		$stmt = $this->dbo->query(sprintf("SELECT * FROM %s WHERE id != '0000'", $this::getTableName()));
		return $stmt->fetchAll();
	}

	public function getByAreaCode($areaCode)
	{
		$stmt = $this->dbo->prepare("SELECT * FROM " . $this::getTableName() . " WHERE AreaCode = :areacode");
		$stmt->execute([':areacode' => $areaCode]);
		return $stmt->fetchAll();
	}

	public function findById($id)
	{
		$stmt = $this->dbo->prepare("SELECT * FROM " . $this::getTableName() . " WHERE id = :id");
		$stmt->execute([':id' => $id]);
		return $stmt->fetch();
	}

	final static function getTableName(): string
	{
		return 'schools';
	}
}