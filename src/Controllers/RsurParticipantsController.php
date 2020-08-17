<?php


namespace App\Controllers;


use App\Repository\RsurParticipantRepository;
use Pecee\Http\Response;

class RsurParticipantsController extends AbstractController
{

    /**
     * @var RsurParticipantRepository
     */
    private $participantRepository;

    public function __construct(RsurParticipantRepository $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    public function getParticipantsWithBadGradesByTest(int $testId): Response
    {
        $date = $this->inputHandler->get('date')->getValue();
        $participants = $this->participantRepository->findBySchoolWithBadGradesByTest(
                '0014',
                $testId,
                $date
        );
        return $this->json($participants);
    }
}