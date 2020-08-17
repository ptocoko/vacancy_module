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

    public function getSubjectsWithDates(): Response
    {
        return $this->json($this->rsurTestsRepository->findSubjectsWithDates());
    }

    public function getTestsAndElements(int $year, int $subject): Response
    {
        $tests = $this->rsurTestsRepository->findInTestByYearAndSubject($year, $subject);
        foreach ($tests as &$test) {
            if ((int)$test['rsur_test_type_id'] === 1) {
                $test['elements'] = $this->rsurElementsRepository->where('test_id', $test['id']);
            }
        }
        return $this->json($tests);
    }
}