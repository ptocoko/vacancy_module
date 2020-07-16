<?php


namespace App\Repository;

use DI\Annotation\Injectable;
use Exception;

/**
 * Class VacancyResponseRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class VacancyResponseRepository extends AbstractRepository
{

	final static function getTableName(): string
	{
		return 'vacancy_responses';
	}

	public function findByVacancyId($vacancyId): array
	{
		$query = "
			SELECT vr.id      AS response_id,
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
			FROM " . $this::getTableName() . " vr
			         JOIN Particips_Directors pd ON pd.id = vr.user_id
			         LEFT OUTER JOIN " . AreaRepository::getTableName() . " a ON pd.areas = a.Code
			         LEFT OUTER JOIN staj st ON st.id = pd.staj
			         LEFT OUTER JOIN qualification q ON q.id = pd.qualificationid
			WHERE vacancy_id = " . $vacancyId;
		$stmt = $this->dbo->query($query);
		return $stmt->fetchAll();
	}

	public function countOfResponsesWith($uesrId, $vacancyId)
	{
		$query = "SELECT COUNT(*) FROM {$this::getTableName()} WHERE user_id = {$uesrId} AND vacancy_id = {$vacancyId}";
		$stmt = $this->dbo->query($query);
		return $stmt->fetchColumn();
	}
	public function saveResponse($vacancyId, $userId, $responseDate, $responseComment, $rday): int
	{
		$this->dbo->beginTransaction();
		try {
			$stmt = $this->dbo->prepare(
				"INSERT INTO {$this::getTableName()} VALUES(NULL, :vid, :uid, :redate, :recomm, :rday)"
			);
			$stmt->execute([':vid' => $vacancyId, ':uid' => $userId, ':redate' => $responseDate, ':recomm' => $responseComment, ':rday' => $rday]);
			$lastId = $this->dbo->lastInsertId();
			$this->dbo->commit();
			return $lastId;
		} catch (Exception $exception) {
			$this->dbo->rollBack();
			return $exception->getMessage();
		}
	}
}