<?php


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

    public function getByVacancy($id = 0)
    {
        $vacancyId = $id == 0 ? $this->inputHandler->get('vid') : $id;
        if ($vacancyId != 0) {
            SimpleRouter::response()->httpCode(200);

            return json_encode($this->repository->findByVacancyId($vacancyId));
        }

        return $this->invalidRequest();
    }

    public function postResponse()
    {
        if (!empty($_SESSION['login'])) {
            $userId = $_SESSION['id'];
            $vacanciId = $this->inputHandler->post('vid');
            if ($this->respondedAlready($userId, $vacanciId)) {
                return $this->invalidRequest(400, 'Вы уже отправили отклик на данную вакансию');
            }
            $response_date = time();
            $response_comment = $this->inputHandler->post('comment');
            $rday = date("d.m.Y");
            if ($userId && $vacanciId) {
                SimpleRouter::response()->httpCode(201);
                try {
                    return json_encode(
                            $this->repository->saveResponse(
                                    $vacanciId,
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
        if ($userId == 0 && $vacancyId == 0) {
            return false;
        }
        return $this->repository->countOfResponsesWith($userId, $vacancyId) > 0;
    }

    public function deleteResponse()
    {
        $id = $this->inputHandler->post('id', 0);
        if ($id != 0) {
            $this->repository->delete($id);
            SimpleRouter::response()->httpCode(200);
            return $id;
        }
        return $this->invalidRequest();
    }
}
