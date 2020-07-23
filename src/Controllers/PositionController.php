<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Repository\PositionRepository;

class PositionController extends AbstractController
{
    /**
     * @var PositionRepository
     */
    private $repository;

    /**
     * PositionController constructor.
     * @param PositionRepository $repository
     */
    public function __construct(PositionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function getAll(): string
    {
        return 'asddd';
        return json_encode($this->repository->findAll());
    }
}
