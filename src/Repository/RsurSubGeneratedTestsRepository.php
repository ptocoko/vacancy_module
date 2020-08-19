<?php


namespace App\Repository;


use App\Config\TableNames;
use Exception;

class RsurSubGeneratedTestsRepository extends AbstractRepository
{

    public static function getTableName(): string
    {
        return TableNames::RSUR['sub_generated_test'];
    }

    public function saveResult(array $elementsAndMarks, int $participantCode, array $minMax, int $element): void
    {
        $sql = 'INSERT INTO rsur_sub_generated_tests(rsur_participi_code, rsur_sub_element_id, mark, hash, grade)
                VALUES (:particip, :subElement, :mark, :hash, :grade)';
        $sql2 = 'INSERT INTO rsur_sub_results(rsur_particip_code, rsur_element_id, sum_marks, generated_test_hash, grade, sum_true_sub_elements) 
                VALUES (:particip, :element, :summarks, :gen_hash, :grade, :sum)';
        $this->dbo->beginTransaction();
        try {
            $stmt = $this->dbo->prepare($sql);
            $stmt2 = $this->dbo->prepare($sql2);
            foreach ($elementsAndMarks as $subElement => $mark) {
                $stmt->execute(
                        [
                                'particip' => $participantCode,
                                'subElement' => $subElement,
                                'mark' => $mark->getValue(),
                                'grade' => $this->getGrade($minMax, $mark, $subElement),
                                'hash' => hash("md5", $participantCode)
                        ]
                );
            }
            $stmt2->execute(['particip' => $participantCode, 'element' => $element,])
            $this->dbo->commit();
        } catch (Exception $exception) {
            $this->dbo->rollBack();
        }
    }

    private function getGrade(array $minMaxs, int $mark, int $subelement)
    {
        foreach ($minMaxs as $minMax) {
            if ((int)$minMax['id'] === $subelement) {
                if ($mark >= (int)$minMax['min']) {
                    return 5;
                }
                if ($mark <= (int)$minMax['min']) {
                    return 2;
                }
                if ($mark >= (int)$minMax['max']) {
                    return 2;
                }
            }
        }
        return null;
    }

    private function getSumMarks(int $particip, int $element)
    {
        $sql = 'SELECT SUM(mark)
                FROM rsur_sub_generated_tests
                WHERE rsur_participi_code = :particip
                AND rsur_element_id = :element';
        $stmt = $this->dbo->prepare($sql);
        $stmt->execute(['par'])
    }
}