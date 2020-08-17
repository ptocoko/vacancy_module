<?php


namespace App\Repository;


use App\Config\TableNames;

class RsurTestsRepository extends AbstractRepository
{

    final public static function getTableName(): string
    {
        return TableNames::RSUR['tests'];
    }


    public function findTestByYearSubjectAndType(int $year, int $subject, int $type): array
    {
        $sql = sprintf(
                'SELECT * FROM %s WHERE rsur_subject_code = :subject AND rsur_years_id = :year AND rsur_test_type_id = :type',
                $this::getTableName()
        );
        $stmt = $this->dbo->prepare($sql);
        $stmt->execute(['year' => $year, 'subject' => $subject, 'type'=>$type]);
        if ($output =  $stmt->fetch())
        {
            return $output;
        }
        return ['code'=>'none'];
    }
}
