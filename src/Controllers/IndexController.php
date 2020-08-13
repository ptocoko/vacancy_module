<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Core\Routes;
use App\Middleware\AuthenticatedUserDataTrait;
use App\Repository\SchoolRepository;
use DI\Annotation\Inject;
use Pecee\SimpleRouter\SimpleRouter;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class IndexController extends AbstractController
{
    use AuthenticatedUserDataTrait;

    /**
     * @Inject
     * @var SchoolRepository
     */
    private $schoolRepository;


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): string
    {
        return $this->render('Login.html.twig', []);
    }

    /**
     * @return string|null
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function login()
    {
        $val = $this->inputHandler->post('exp');
        if ($val == '1') {
            $_SESSION['id'] = "1251";
            $_SESSION['work'] = '2';
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE . 'director');
        } elseif ($val == '2') {
            $_SESSION['id'] = "1253";
            $_SESSION['work'] = '1';
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE . 'teacher');
        }
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function teacher(): string
    {
        return $this->render('Teacher.html.twig', []);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function director(): string
    {
        $params['school'] = $this->schoolRepository->findById(SimpleRouter::request()->user->schoolid);
        return $this->render('Director.html.twig', $params);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function notFound(): string
    {
        return $this->render('404.html.twig', []);
    }

}
