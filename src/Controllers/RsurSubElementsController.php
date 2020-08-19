<?php


namespace App\Controllers;


use App\Repository\RsurSubElementsRepository;

class RsurSubElementsController extends AbstractController
{
    /**
     * @var RsurSubElementsRepository
     */
    private $rsurSubElementsRepository;

    /**
     * RsurSubElementsController constructor.
     * @param RsurSubElementsRepository $rsurSubElementsRepository
     */
    public function __construct(RsurSubElementsRepository $rsurSubElementsRepository)
    {
        $this->rsurSubElementsRepository = $rsurSubElementsRepository;
    }

    public function getSubelementsByElement(): string
    {
        $element = (int)$this->inputHandler->get('element')->getValue();
        $subElements = $this->rsurSubElementsRepository->findSubElementsByElementId($element);
        return $this->render('ElementInputs.html.twig', ['subelements' => $subElements]);
    }

}