<?php


namespace App\Repository;

use DI\Annotation\Injectable;

/**
 * Class ParticipDirectorRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class ParticipDirectorRepository extends AbstractRepository
{

    public function getById($id)
    {
        $stmt = $this->dbo->prepare("SELECT * FROM " . $this::getTableName() . " WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    final static function getTableName(): string
    {
        return 'Particips_Directors';
    }

    public function findTeachersOnly()
    {
        $stmt = $this->dbo->query(
            sprintf(
                "SELECT p.id, p.surname, p.name, p.secondname, p.birthday, p.staj, p.email, p.telefon, a.name as areaName FROM %s p
			JOIN sertusers s ON s.hash = p.log_hash
			JOIN %s a ON p.areas = a.code
			WHERE s.work = 1",
                $this::getTableName(),
                AreaRepository::getTableName()
            )
        );
        return $stmt->fetchAll();
    }
}