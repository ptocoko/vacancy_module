<?php


namespace App\Controllers;


use App\Repository\SchoolRepository;
use DI\Annotation\Injectable;

/**
 * Class SchoolController
 * @package App\Controllers
 * @Injectable(lazy=true)
 */
class SchoolController extends AbstractController
{
	/**
	 * @var SchoolRepository
	 */
	private $repository;

	/**
	 * SchoolController constructor.
	 * @param SchoolRepository $repository
	 */
	public function __construct(SchoolRepository $repository)
	{

		$this->repository = $repository;
	}

	public function getAll()
	{
		return json_encode($this->repository->findAll());
	}


	public function getById($id = 0)
	{
		if ($id == 0) {
			$id = $this->inputHandler->get('id');
		}
		if ($id != 0) {
			return json_encode($this->repository->findById($id));
		}
		return $this->BadRequest();
	}

	public function getByAreaCode()
	{
		$areacode = $this->inputHandler->get('areacode', 0);
		if ($areacode != 0) {
			return json_encode($this->repository->getByAreaCode($areacode));
		}
		return $this->BadRequest();
	}
}