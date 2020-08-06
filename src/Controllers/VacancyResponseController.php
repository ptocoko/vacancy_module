<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Domain\Dialog;
use App\Domain\DialogParticipant;
use App\Domain\UserRoles;
use App\Repository\DialogsRepository;
use App\Repository\ParticipantDirectorRepository;
use App\Repository\VacancyResponseRepository;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;

class VacancyResponseController extends AbstractController
{
    /**
     * @var VacancyResponseRepository
     */
    private $vacancyResponseRepository;
    /**
     * @var DialogsRepository
     */
    private $dialogsRepository;
    /**
     * @var ParticipantDirectorRepository
     */
    private $participantDirectorRepository;

    /**
     * VacancyResponseController constructor.
     * @param VacancyResponseRepository $vacancyResponseRepository
     * @param DialogsRepository $dialogsRepository
     * @param ParticipantDirectorRepository $participantDirectorRepository
     */
    public function __construct(
            VacancyResponseRepository $vacancyResponseRepository,
            DialogsRepository $dialogsRepository,
            ParticipantDirectorRepository $participantDirectorRepository
    ) {
        $this->vacancyResponseRepository = $vacancyResponseRepository;
        $this->dialogsRepository = $dialogsRepository;
        $this->participantDirectorRepository = $participantDirectorRepository;
    }

    public function getByVacancy(int $vacancyId): Response
    {
        return $this->json($this->vacancyResponseRepository->findByVacancyId($vacancyId));
    }

    public function create()
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
                $this->vacancyResponseRepository->saveResponse(
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
        return $this->vacancyResponseRepository->countOfResponsesWith($userId, $vacancyId) > 0;
    }

    public function delete(
            int $id
    ): string {
        return (string)$this->vacancyResponseRepository->delete($id);
    }

    public function accept(int $responseId): void
    {
        $teacherId = $this->vacancyResponseRepository->findById($responseId)['user_id'];
        $teacher = $this->participantDirectorRepository->findUserData($teacherId);
        $user = SimpleRouter::request()->user;
        $this->vacancyResponseRepository->setAccepted($responseId);
        $this->dialogsRepository->save(new Dialog($responseId, $user, $teacher));
    }

    public function getDialog(int $responseId)
    {
        $user = SimpleRouter::request()->user;
        return $this->render(
                'Dialog.html.twig',
                [
                        'name' => $user->getName(),
                        'id' => $user->id,
                        'role' => UserRoles::DIRECTOR,
                        'responseId' => $responseId
                ]
        );
    }
}
