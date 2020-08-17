<?php


namespace App\Controllers;


use App\Repository\RsurElementsRepository;
use App\Repository\RsurSubjectsRepository;
use App\Repository\RsurTestsRepository;
use Pecee\Http\Response;

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
    /**
     * @var RsurElementsRepository
     */
    private $rsurElementsRepository;

    public function __construct(
            RsurTestsRepository $rsurTestsRepository,
            RsurSubjectsRepository $rsurSubjectsRepository,
            RsurElementsRepository $rsurElementsRepository
    ) {
        $this->rsurTestsRepository = $rsurTestsRepository;
        $this->rsurSubjectsRepository = $rsurSubjectsRepository;
        $this->rsurElementsRepository = $rsurElementsRepository;
    }

    public function getTestsAndElements(): Response
    {
        $year = (int)$this->inputHandler->get('year')->getValue();
        $subject = (int)$this->inputHandler->get('subject')->getValue();
        $tests['in'] = $this->rsurTestsRepository->findTestByYearSubjectAndType($year, $subject, 1);
        $tests['out'] = $this->rsurTestsRepository->findTestByYearSubjectAndType($year, $subject, 2);
        $tests['elements'] = $this->rsurElementsRepository->where('test_id', $tests['in']['id']);

        return $this->json($tests);
    }
}
