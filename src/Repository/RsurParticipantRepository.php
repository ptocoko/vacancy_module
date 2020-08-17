<?php


namespace App\Repository;


use App\Config\StoredDataTypes;
use App\Config\TableNames;

class RsurParticipantRepository extends AbstractRepository
{

    public function findBySchoolWithBadGradesByTest(string $schoolId, int $testId, string $date): array
    {
        $sql = sprintf(
                "SELECT code,
                       surname,
                       name,
                       secondname,
                       school_id,
                       actualcode,
                       sum_marks,
                       subjectcode,
                       generatedtesthash,
                       grade,
                       comment,
                       min,
                       max,
                       data,
                       rsur_test_type_id
                FROM %s AS rp
                         LEFT OUTER JOIN %s rr ON rr.rsur_particip_code = rp.code
                         LEFT OUTER JOIN %s rt on rr.test_id = rt.id
                WHERE rp.school_id = :schoolid
                  AND rt.id = :testid
                  AND rr.grade = 2
                  AND rt.data = :date
                  AND rt.actual = %d
                  AND rp.actualcode = %d",
                $this::getTableName(),
                RsurResultsRepository::getTableName(),
                RsurTestsRepository::getTableName(),
                StoredDataTypes::IS_ACTUAL,
                StoredDataTypes::IS_ACTUAL
        );
        $stmt = $this->dbo->prepare($sql);
        $stmt->execute(['schoolid' => $schoolId, 'testid' => $testId, 'date' => $date]);
        return $stmt->fetchAll();
    }

    final public static function getTableName(): string
    {
        return TableNames::RSUR['participants'];
    }


}