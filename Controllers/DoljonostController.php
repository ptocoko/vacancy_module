<?php


namespace App\Controllers;


use App\Repository\DoljnostRepository;

class DoljonostController extends AbstractController
{
    /**
     * @var DoljnostRepository
     */
    private $repository;

    /**
     * DoljonostController constructor.
     * @param DoljnostRepository $repository
     */
    public function __construct(DoljnostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return json_encode($this->repository->findAll());
    }
}
