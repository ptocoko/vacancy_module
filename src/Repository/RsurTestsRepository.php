<?php


namespace App\Repository;


use App\Config\TableNames;

class RsurTestsRepository extends AbstractRepository
{

    public function findSubjectsWithDates(): array
    {
        $sql = sprintf(
                'SELECT rs.code as subject, ry.id as year, rs.name, ry.value
                FROM %s AS rt
                         JOIN %s ry ON rt.rsur_years_id = ry.id
                         JOIN %s rs ON rt.rsur_subject_code = rs.code
                WHERE rt.rsur_test_type_id = 1',
                $this::getTableName(),
                RsurYearsRepository::getTableName(),
                RsurSubjectsRepository::getTableName()
        );
        $stmt = $this->dbo->query($sql);
        return $stmt->fetchAll();
    }

    final public static function getTableName(): string
    {
        return TableNames::RSUR['tests'];
    }

    public function findInTestByYearAndSubject(int $year, int $subject): array
    {
        $sql = sprintf(
                'SELECT * FROM %s WHERE rsur_subject_code = :subject AND rsur_years_id = :year',
                $this::getTableName()
        );
        $stmt = $this->dbo->prepare($sql);
        $stmt->execute(['year' => $year, 'subject' => $subject]);
        return $stmt->fetchAll();
    }
}