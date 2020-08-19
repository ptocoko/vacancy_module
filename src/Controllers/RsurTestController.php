<?php


namespace App\Controllers;


use App\Repository\RsurElementsRepository;
use App\Repository\RsurResultsRepository;
use App\Repository\RsurSubElementsRepository;
use App\Repository\RsurSubResultsRepository;
use App\Repository\RsurTestsRepository;

class RsurTestController extends AbstractController
{
    /**
     * @var RsurTestsRepository
     */
    private $rsurTestsRepository;
    /**
     * @var RsurElementsRepository
     */
    private $rsurElementsRepository;
    /**
     * @var RsurResultsRepository
     */
    private $rsurResultsRepository;
    /**
     * @var RsurSubElementsRepository
     */
    private $rsurSubElementsRepository;
    /**
     * @var RsurSubResultsRepository
     */
    private $rsurSubResultsRepository;

    public function __construct(
            RsurTestsRepository $rsurTestsRepository,
            RsurElementsRepository $rsurElementsRepository,
            RsurResultsRepository $rsurResultsRepository,
            RsurSubElementsRepository $rsurSubElementsRepository,
            RsurSubResultsRepository $rsurSubResultsRepository
    ) {
        $this->rsurTestsRepository = $rsurTestsRepository;
        $this->rsurElementsRepository = $rsurElementsRepository;
        $this->rsurResultsRepository = $rsurResultsRepository;
        $this->rsurSubElementsRepository = $rsurSubElementsRepository;
        $this->rsurSubResultsRepository = $rsurSubResultsRepository;
    }

    public function getTestsAndElements(): string
    {
        $year = (int)$this->inputHandler->get('year')->getValue();
        $subject = (int)$this->inputHandler->get('subject')->getValue();
        $particip = (int)$this->inputHandler->get('particip')->getValue();

        $tests['incoming'] = $this->rsurTestsRepository->findTestByYearSubjectAndType($year, $subject, 1);
        $inResult = $this->rsurResultsRepository->findResultByTestId($tests['incoming']['id'], $particip);
        $tests['incoming']['elements'] = $this->rsurElementsRepository->where('test_id', $tests['incoming']['id']);
        $tests['incoming']['result'] = round(
                $inResult['sum_true_elements'] / count($tests['incoming']['elements']) * 100
        );

        $tests['out'] = $this->rsurTestsRepository->findTestByYearSubjectAndType($year, $subject, 2);
        $tests['out']['elements'] = $this->rsurElementsRepository->where('test_id', $tests['out']['id']);
        $outResult = $this->rsurResultsRepository->findResultByTestId($tests['incoming']['id'], $particip);
        if (count($tests['out']['elements']) > 0 && count($outResult) > 0) {
            $tests['out']['result'] = round($outResult['sum_true_elements'] / count($tests['out']['elements']) * 100);
        } else {
            $tests['out']['result'] = 0;
        }
        foreach ($tests['incoming']['elements'] as &$element) {
            if (checkInRange($element['begin_date'], $element['end_date'], date('d.m.Y'))) {
                $element['enable'] = 1;
            } else {
                $element['enable'] = 0;
            }
            $elementResult = $this->rsurSubResultsRepository->findResultByElementAndParticip(
                    $element['id'],
                    $particip
            );
            $element['subelements'] = $this->rsurSubElementsRepository->findSubElementsByElementId($element['id']);
            if (count($element['subelements']) > 0 && count($elementResult) > 0) {
                $element['result'] = round($outResult['sum_true_sub_elements'] / count($element['subelements']) * 100);
            } else {
                $element['result'] = 0;
            }
        }

        return $this->render('Blocks.html.twig', ['tests' => $tests]);
    }
}
