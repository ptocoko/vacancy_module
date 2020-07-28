<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Repository\VacancyResponseRepository;
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
        $vacancyId = (int)$this->inputHandler->post('vid')->getValue();
        if ($this->respondedAlready(SimpleRouter::request()->user->id, $vacancyId)) {
            return $this->invalidRequest(407, 'Вы уже отправили отклик на данную вакансию');
        }
        $responseDate = time();
        $responseComment = $this->inputHandler->post('comment')->getValue();
        $responseDay = date("d.m.Y");
        SimpleRouter::response()->httpCode(201);
        return json_encode(
                $this->repository->saveResponse(
                        $vacancyId,
                        SimpleRouter::request()->user->id,
                        $responseDate,
                        $responseComment,
                        $responseDay
                )
        );
    }

    private function respondedAlready(
            int $userId,
            int $vacancyId
    ): bool {
        return $this->repository->countOfResponsesWith($userId, $vacancyId) > 0;
    }

    public function delete(
            int $id
    ): string {
        return (string)$this->repository->delete($id);
    }
}
