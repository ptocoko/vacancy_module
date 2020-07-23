<?php


namespace App\Controllers;


use App\Repository\ParticipantDirectorRepository;
use App\Repository\VacancyRepository;
use App\Repository\VacancyResponseRepository;
use Exception;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;

class VacancyController extends AbstractController
{
    /**
     * @var VacancyRepository
     */
    private $vacancyRepository;
    /**
     * @var VacancyResponseRepository
     */
    private $vacancyResponseRepository;
    /**
     * @var ParticipantDirectorRepository
     */


    /**
     * VacancyController constructor.
     * @param VacancyRepository $vacancyRepository
     * @param VacancyResponseRepository $vacancyResponseRepository
     */
    public function __construct(
            VacancyRepository $vacancyRepository,
            VacancyResponseRepository $vacancyResponseRepository
    ) {
        $this->vacancyRepository = $vacancyRepository;
        $this->vacancyResponseRepository = $vacancyResponseRepository;
    }

    public function getSortedData(): string
    {
        $areaCode = (int)$this->inputHandler->get('ac', '0');
        $schoolId = (int)$this->inputHandler->get('schid', '0');
        $positionId = (int)$this->inputHandler->get('pid', '0');
        $payment['min'] = (int)$this->inputHandler->get('pmin', '0');
        $payment['max'] = (int)$this->inputHandler->get('pmax', '0');
        if ($payment['min'] === 0 && $payment['max'] === 0) {
            $payment = null;
        }
        $experienceId = (int)$this->inputHandler->get('staid', '0');
        $offset = (int)$this->inputHandler->get('page', '0');
        return $this->json(
                $this->vacancyRepository->findBySorting(
                        $areaCode,
                        $schoolId,
                        $positionId,
                        $payment,
                        $experienceId,
                        $offset * 9
                )
        );
    }

    public function getBySchool(): Response
    {
        $vacancies = $this->vacancyRepository->findBySchoolId(SimpleRouter::request()->user->schoolid);
        foreach ($vacancies as &$vacancy) {
            $vacancy['resp'] = $this->vacancyResponseRepository->findByVacancyId((int)$vacancy['id']);
        }
        return $this->json($vacancies);
    }


    public function deleteVacancy(int $id): string
    {
        return $this->vacancyRepository->delete($id);
    }

    public function postVacancy()
    {
        try {
            if (!$director
                    = json_decode(
                    $this->participantDirectorController->getById(),
                    true,
                    512
            )
            ) {
                return $this->invalidRequest(
                        401,
                        'Пожалуйста зайдите в свой личный кабинет или зарегестрируйтесь'
                );
            }
        } catch (Exception $e) {
            return $this->invalidRequest(400, $e->getMessage());
        }
        try {
            if (!$school = json_decode($this->schoolController->getById($director['schoolid']), true, 512)) {
                return $this->invalidRequest(
                        400,
                        'В вашем личном кабинете не установлена школа'
                );
            }
        } catch (Exception $e) {
            return $this->invalidRequest(400, $e->getMessage());
        }
        $doljnostid = $this->inputHandler->post('pid', 0);
        if ($this->vacancyExists($doljnostid, $school['id'])) {
            return $this->invalidRequest(400, 'Данная вакансия уже существует');
        }
        $stajId = $this->inputHandler->post('staid', 0);
        $zp = 'no';
        $temp = (int)$_POST['payment'];
        if ($temp > 0) {
            $zp = $temp;
        }
        $dopInfo = $this->inputHandler->post('dopinfo', "");
        $dateInsert = date("d.m.Y");
        if ($doljnostid != 0 && $stajId != 0) {
            try {
                SimpleRouter::response()->header('Content-Type: application/json');
                $vacancy = $this->vacancyRepository->saveVacancy(
                        $doljnostid,
                        $zp,
                        $stajId,
                        $dopInfo,
                        $director['id'],
                        $director['schoolid'],
                        $school['AreaCode'],
                        $dateInsert
                );
                $vacancy['resp'] = [];
                return json_encode($vacancy, JSON_PRETTY_PRINT, 4);
            } catch (Exception $e) {
                return $this->invalidRequest(400, $e->getMessage());
            }
        }

        return $this->invalidRequest();
    }

    public function vacancyExists(
            $doljnostId = 0,
            $schoolId = 0
    ): bool {
        if ($schoolId == 0 && $doljnostId == 0) {
            return false;
        }
        if ($this->vacancyRepository->countOfVacanciesWith($doljnostId, $schoolId) > 0) {
            return true;
        }
        return false;
    }

    public function updateVacancy()
    {
        $doljnostid = $this->inputHandler->post('pid', 0);
        $stajId = $this->inputHandler->post('staid', 0);
        $zp = 'no';
        $temp = (int)$_POST['payment'];
        if ($temp > 0) {
            $zp = $temp;
        }
        $dopInfo = $this->inputHandler->post('dopinfo', "");
        $id = $this->inputHandler->post('id');
        if ($doljnostid != 0 && $stajId != 0) {
            SimpleRouter::response()->header('Content-Type: application/json');
            $vacancy = $this->vacancyRepository->updateVacancy($id, $doljnostid, $zp, $stajId, $dopInfo);
            $vacancy['resp'] = [];
            return json_encode($vacancy, JSON_PRETTY_PRINT, 512);
        }
        return $this->invalidRequest();
    }
}
