<?php


namespace App\Controllers;


use App\Repository\RsurSubjectsRepository;
use App\Repository\RsurTestsRepository;

class RsurTestController extends AbstractController
{
    /**
     * @var RsurTestsRepository
     */
    private $rsurTestsRepository;
    /**
     * @var RsurSubjectsRepository
     */
    private $rsurSubjectsRepository;

    public function __construct(
            RsurTestsRepository $rsurTestsRepository,
            RsurSubjectsRepository $rsurSubjectsRepository
    ) {
        $this->rsurTestsRepository = $rsurTestsRepository;
        $this->rsurSubjectsRepository = $rsurSubjectsRepository;
    }

    public function getTestsWithSubjects()
    {
        $tests = $this->rsurTestsRepository->findAll();
        foreach ($tests as &$test) {
            $test['subject'] = $this->rsurSubjectsRepository->find($test['rsur_subject_code']);
        }
        return $this->json($tests);
    }
}