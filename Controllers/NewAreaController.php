<?php

namespace App\Controllers;

use App\Repository\AreaRepository;

class NewAreaController extends AbstractController
{
    private $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAll()
    {
        return json_encode($this->areaRepository->findAll());
    }

    public function getByCode()
    {
        $code = $this->inputHandler->get('code', 0);
        if ($code !== 0) {
            return json_encode($this->areaRepository->findByCode($code));
        }

        return $this->BadRequest(400);
    }

}
