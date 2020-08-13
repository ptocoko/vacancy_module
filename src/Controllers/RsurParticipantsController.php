<?php


namespace App\Controllers;


use App\Repository\RsurParticipantRepository;
use App\Repository\RsurTestsRepository;

class RsurParticipantsController extends AbstractController
{
    /**
     * @var RsurTestsRepository
     */
    private $rsurTestsRepository;
    /**
     * @var RsurParticipantRepository
     */
    private $participantRepository;

    public function __construct(
            RsurTestsRepository $rsurTestsRepository,
            RsurParticipantRepository $participantRepository
    ) {
        $this->rsurTestsRepository = $rsurTestsRepository;
        $this->participantRepository = $participantRepository;
    }

    public function getParticipantsWithBadGradesByTest(int $testId)
    {
        $participants = $this->participantRepository->findBySchool(000000);
    }
}