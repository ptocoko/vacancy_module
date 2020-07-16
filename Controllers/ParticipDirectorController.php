<?php


namespace App\Controllers;


use App\Repository\ParticipDirectorRepository;
use DI\Annotation\Injectable;

/**
 * Class ParticipDirectorController
 * @package App\Controllers
 * @Injectable(lazy=true)
 */
class ParticipDirectorController extends AbstractController
{
	/**
	 * @var ParticipDirectorRepository
	 */
	private $repository;

	/**
	 * ParticipDirectorController constructor.
	 * @param ParticipDirectorRepository $repository
	 */
	public function __construct(ParticipDirectorRepository $repository)
	{
		$this->repository = $repository;
	}

	public function getById($id = 0)
	{
		if ($id != '0') {
			return json_encode($this->repository->getById($id));
		}
		if (!empty($_SESSION['id'])) {
			return json_encode($this->repository->getById($_SESSION['id']));
		}
		if ($this->inputHandler->exists('id')) {
			return json_encode($this->repository->getById($this->inputHandler->get('id', 0)));
		}
		return $this->BadRequest(404, 'Not found');
	}
}
