<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repository\AreaRepository;

class AreaController extends AbstractController
{
    private $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAll(): string
    {
        return json_encode($this->areaRepository->findAll());
    }

    public function getByCode(int $code): string
    {
        return json_encode($this->areaRepository->findByCode($code));
    }

}
