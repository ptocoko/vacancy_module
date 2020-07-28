<?php


namespace App\Controllers;


use App\Domain\DialogParticipant;
use App\Repository\DialogsRepository;
use App\Repository\MessageRepository;
use App\Repository\ParticipantDirectorRepository;
use App\Repository\VacancyResponseRepository;
use Pecee\SimpleRouter\SimpleRouter;

class DialogsController extends AbstractController
{
    /**
     * @var DialogsRepository
     */
    private $dialogsRepository;
    /**
     * @var ParticipantDirectorRepository
     */
    private $participantDirectorRepository;
    /**
     * @var VacancyResponseRepository
     */
    private $vacancyResponseRepository;
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    public function __construct(
            DialogsRepository $dialogsRepository,
            ParticipantDirectorRepository $participantDirectorRepository,
            VacancyResponseRepository $vacancyResponseRepository,
            MessageRepository $messageRepository
    ) {
        $this->dialogsRepository = $dialogsRepository;
        $this->participantDirectorRepository = $participantDirectorRepository;
        $this->vacancyResponseRepository = $vacancyResponseRepository;
        $this->messageRepository = $messageRepository;
    }

    public function create(int $vacancyId, int $teacherId): void
    {
        $teacher = $this->participantDirectorRepository->findById($teacherId);
        $responseId = (int)$this->inputHandler->post('respid')->getValue();
        $user = SimpleRouter::request()->user;
        $this->vacancyResponseRepository->setAccepted($responseId);
        $this->dialogsRepository->saveRoom(
                $vacancyId,
                new DialogParticipant($user->id, $user->name, $user->type),
                new DialogParticipant($teacher->id, $teacher->name, $teacher->type)
        );
    }

    public function getDialogsByParticipant()
    {
        return $this->json(
                $this->dialogsRepository->findInterlocutorsByParticipantId(SimpleRouter::request()->user->id)
        );
    }
}