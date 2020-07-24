<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Repository\VacancyResponseRepository;
use Exception;
use Pecee\SimpleRouter\SimpleRouter;

class VacancyResponseController extends AbstractController
{
    /**
     * @var VacancyResponseRepository
     */
    private $repository;

    /**
     * VacancyResponseController constructor.
     * @param VacancyResponseRepository $repository
     */
    public function __construct(VacancyResponseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByVacancy(int $vacancyId)
    {
        return $this->json($this->repository->findByVacancyId($vacancyId));
    }

    public function post()
    {
        if (!empty($_SESSION['login'])) {
            $userId = $_SESSION['id'];
            $vacancyId = $this->inputHandler->post('vid');
            if ($this->respondedAlready($userId, $vacancyId)) {
                return $this->invalidRequest(407, 'Вы уже отправили отклик на данную вакансию');
            }
            $response_date = time();
            $response_comment = $this->inputHandler->post('comment');
            $rday = date("d.m.Y");
            if ($userId && $vacancyId) {
                SimpleRouter::response()->httpCode(201);
                try {
                    return json_encode(
                            $this->repository->saveResponse(
                                    $vacancyId,
                                    $userId,
                                    $response_date,
                                    $response_comment,
                                    $rday
                            )
                    );
                } catch (Exception $e) {
                    return $this->invalidRequest();
                }
            } else {
                SimpleRouter::response()->httpCode(400);
                return 'Bad request';
            }
        } else {
            return $this->invalidRequest(401, 'Пожалуйста зайдите в свой личный кабинет или зарегестрируйтесь');
        }
    }

    private function respondedAlready($userId, $vacancyId): bool
    {
        return $this->repository->countOfResponsesWith($userId, $vacancyId) > 0;
    }

    public function delete(int $id): string
    {
        return (string)$this->repository->delete($id);
    }
}
