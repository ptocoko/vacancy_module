<?php

declare(strict_types=1);

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

    public function getAll(): string
    {
        return json_encode($this->repository->findAll());
    }


    public function getById(): string
    {
        $id = (int)$this->inputHandler->get('id', '0');
        return json_encode($this->repository->findById($id));
    }

    public function getByAreaCode(): string
    {
        $areaCode = (int)$this->inputHandler->get('areacode', '0');
        return json_encode($this->repository->getByAreaCode($areaCode));
    }
}