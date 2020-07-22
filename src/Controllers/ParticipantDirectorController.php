<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Repository\ParticipantDirectorRepository;
use DI\Annotation\Injectable;

/**
 * Class ParticipantDirectorController
 * @package App\Controllers
 * @Injectable(lazy=true)
 */
class ParticipantDirectorController extends AbstractController
{
    /**
     * @var ParticipantDirectorRepository
     */
    private $repository;

    /**
     * ParticipantDirectorController constructor.
     * @param ParticipantDirectorRepository $repository
     */
    public function __construct(ParticipantDirectorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function getById(): string
    {
        if ($this->inputHandler->exists('id')) {
            return json_encode($this->repository->findById((int)$this->inputHandler->get('id')));
        } elseif (!empty($_SESSION['id'])) {
            return json_encode($this->repository->findById((int)$_SESSION['id']));
        } else {
            return $this->errorResponse(404, 'Not found');
        }
    }
}
