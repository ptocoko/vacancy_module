<?php


namespace App\Repository;

use App\Config\TableNames;
use DI\Annotation\Injectable;

/**
 * Class VacancyResponseRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class VacancyResponseRepository extends AbstractRepository
{

    public function findByVacancyId($vacancyId): array
    {
        $query = sprintf(
                "SELECT vr.id      AS response_id,
                               vr.response_day,
                               pd.id      AS prticip_id,
                               q.name     AS quality_name,
                               st.value   AS particip_staj,
                               a.name     AS area_name,
                               pd.birthday,
                               pd.dopinfo,
                               pd.doljnost,
                               pd.name,
                               pd.secondname,
                               pd.surname,
                               pd.telefon,
                               pd.email,
                               vr.response_comment
                        FROM %s vr
                                 JOIN %s pd ON pd.id = vr.user_id
                                 LEFT OUTER JOIN %s a ON pd.areas = a.Code
                                 LEFT OUTER JOIN %s st ON st.id = pd.staj
                                 LEFT OUTER JOIN %s q ON q.id = pd.qualificationid
                        WHERE vacancy_id = :id",
                $this::getTableName(),
                ParticipantDirectorRepository::getTableName(),
                AreaRepository::getTableName(),
                ExperienceRepository::getTableName(),
                QualificationRepository::getTableName(),
        );
        $stmt = $this->dbo->prepare($query);
        $stmt->execute(['id' => $vacancyId]);
        return $stmt->fetchAll();
    }

    final static function getTableName(): string
    {
        return TableNames::VACANCY_RESPONSES;
    }

    public function countOfResponsesWith(int $userId, int $vacancyId): array
    {
        $query = sprintf(
                "SELECT COUNT(*) FROM %s WHERE user_id = :userId AND vacancy_id = :vacancyId",
                $this::getTableName()
        );
        $stmt = $this->dbo->prepare($query);
        $stmt->execute([':userId' => $userId, 'vacancyId' => $vacancyId]);
        return $stmt->fetchColumn();
    }

    public function saveResponse(
            int $vacancyId,
            int $userId,
            string $responseDate,
            string $responseComment,
            string $responseDay
    ): int {
        $stmt = $this->dbo->prepare(
                sprintf("INSERT INTO %s VALUES(NULL, :vid, :uid, :redate, :recomm, :rday)", $this::getTableName())
        );
        $stmt->execute(
                [
                        ':vid' => $vacancyId,
                        ':uid' => $userId,
                        ':redate' => $responseDate,
                        ':recomm' => $responseComment,
                        ':rday' => $responseDay
                ]
        );
        return (int)$this->dbo->lastInsertId();
    }
}