<?php


namespace App\Repository;


use DI\Annotation\Injectable;
use Exception;

/**
 * Class VacancyRepository
 * @package App\Repository
 * @Injectable(lazy=true)
 */
class VacancyRepository extends AbstractRepository
{
	/**
	 * @var int
	 */
	private $flag = 0;

	final static function getTableName(): string
	{
		return 'vacancy';
	}

	public function findBySorting($areaCode, $schoolId, $doljnostId, $payment, $stajId, $offset = 0): array
	{
		$sql = "select v.id             as id,
					   zp               as zp,
					   d.name           as 'doljnost',
					   d.typedoljnostid as doljtype,
					   a.name           as areaname,
					   sch.name         as schoolname,
					   st.value         as staj,
					   v.dop_info,
					   v.date_insert
				from " . $this::getTableName() . " v
						 join " . DoljnostRepository::getTableName() . " d on v.doljnost_id = d.id
						 join " . AreaRepository::getTableName() . " a on v.areacode = a.Code
						 join " . SchoolRepository::getTableName() . " sch on v.schoolid = sch.id
						 join staj st on v.staj_id = st.id";
		if ($areaCode != '0000') {
			$cond = "v.areacode = {$areaCode}";
			$this->constructSql($sql, $cond);
		}
		if ($schoolId != 0) {
			$cond = "v.schoolid = {$schoolId}";
			$this->constructSql($sql, $cond);
		}
		if ($doljnostId != 0) {
			$cond = "v.doljnost_id = {$doljnostId}";
			$this->constructSql($sql, $cond);
		}
		if ($payment['min'] != 0 || $payment['max'] != 0) {
			$cond = "v.zp BETWEEN " . $payment['min'] . " AND " . $payment['max'];
			$this->constructSql($sql, $cond);
		}
		if ($payment['min'] == 'no' && $payment['max'] == 'no') {
			$cond = "v.zp = 'no'";
			$this->constructSql($sql, $cond);
		}
		if ($stajId != 0) {
			$cond = "v.staj_id = {$stajId}";
			$this->constructSql($sql, $cond);
		}
		$sql .= " order by v.date_insert
				limit 9 offset {$offset}";
		return $this->dbo->query($sql)->fetchAll();
	}

	private function constructSql(string &$sql, string $cond): string
	{
		if ($this->flag == 0) {
			$this->flag = 1;
			$sql .= " WHERE " . $cond;
			return $sql;
		}
		$sql .= " AND " . $cond;
		return $sql;
	}

	public function findBySchoolId(string $schoolId): array
	{
		$stmt = $this->dbo->prepare("SELECT  v.id, v.zp, v.date_insert, v.dop_info, v.schoolid, v.id_directora, v.doljnost_id, v.staj_id, d.name, d.typedoljnostid as dtype, s.value
											FROM " . $this::getTableName() . " v  
											join " . DoljnostRepository::getTableName() . " d on v.doljnost_id = d.id
											join staj s on v.staj_id = s.id
											WHERE schoolid = :schoolId");
		$stmt->execute([':schoolId' => $schoolId]);
		return $stmt->fetchAll();
	}

	public function countOfVacanciesWith($doljnostId, $schoolId)
	{
		$stmt = $this->dbo->query("SELECT COUNT(*) FROM " . $this::getTableName() . " WHERE doljnost_id = " . $doljnostId . " AND schoolid = " . $schoolId);
		return $stmt->fetchColumn();
	}

	public function saveVacancy($doljnostId, $zp, $stajId, $dopInfo, $idDirectora, $schoolId, $areaCode, $dateInsert)
	{
		$this->dbo->beginTransaction();
		try {
			$stmt = $this->dbo
				->prepare("INSERT INTO " . $this::getTableName() . "(
                  id,
                  doljnost_id,
                  zp,
                  staj_id,
                  dop_info,
                  id_directora,
                  schoolid,
                  areacode,
                  date_insert)
				VALUE (null,
					   :doljnostId,
					   :zp,
					   :staj_id,
					   :dop_info,
					   :id_directora,
					   :schoolId,
					   :areacode,
					   :date_insert)");
			$stmt->execute([':doljnostId' => $doljnostId,
				':zp' => $zp,
				':staj_id' => $stajId,
				':dop_info' => $dopInfo,
				':id_directora' => $idDirectora,
				':schoolId' => $schoolId,
				':areacode' => $areaCode,
				'date_insert' => $dateInsert]);
			$lastId = $this->dbo->lastInsertId();
			$this->dbo->commit();

			return $this->findById($lastId);
		} catch (Exception $exception) {
			$this->dbo->rollBack();

			return $exception->getMessage();
		}
	}

	public function findById($id)
	{
		$stmt = $this->dbo->prepare("SELECT  v.id, v.zp, v.date_insert, v.dop_info, v.doljnost_id, v.staj_id, d.name, d.typedoljnostid as dtype, s.value
											FROM " . $this::getTableName() . " v
											join " . DoljnostRepository::getTableName() . " d on v.doljnost_id = d.id
											join staj s on v.staj_id = s.id
											WHERE v.id = :id");
		$stmt->execute([':id' => $id]);
		return $stmt->fetch();
	}

	public function updateVacancy($id, $did, $zp, $stid, $dopInfo)
	{
		$sql = "update " . $this::getTableName() . "
					set doljnost_id = ?,
				    zp          = ?,
				    staj_id     = ?,
				    dop_info    = ?
				where id = ?";
		$this->dbo->beginTransaction();
		try {
			$stmt = $this->dbo->prepare($sql);
			$stmt->execute([$did, $zp, $stid, $dopInfo, $id]);
			$vaca = $this->findById($id);
			$this->dbo->commit();

			return $vaca;
		} catch (Exception $exception) {
			$this->dbo->rollBack();

			return $exception->getMessage();
		}
	}
}
