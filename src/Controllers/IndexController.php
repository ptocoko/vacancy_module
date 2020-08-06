<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Domain\UserRoles;
use App\Middleware\AuthenticatedUserDataTrait;
use App\Repository\SchoolRepository;
use DI\Annotation\Inject;

class IndexController extends AbstractController
{
    use AuthenticatedUserDataTrait;

    /**
     * @Inject
     * @var SchoolRepository
     */
    private $schoolRepository;


    public function index(): string
    {
        if ($this->getAuthenticatedUser()->type === UserRoles::DIRECTOR) {
            $params['school'] = $this->schoolRepository->findById($this->getAuthenticatedUser()->schoolid);
            return $this->render('Director.html.twig', $params);
        }
        return $this->render('Teacher.html.twig', []);
    }
}
