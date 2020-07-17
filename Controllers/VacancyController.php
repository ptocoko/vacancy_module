<?php


namespace App\Controllers;


use App\Repository\VacancyRepository;
use DI\Annotation\Inject;
use Exception;
use Pecee\SimpleRouter\SimpleRouter;

class VacancyController extends AbstractController
{
    /**
     * @var VacancyRepository
     */
    private $repository;

    /**
     * @Inject
     * @var ParticipDirectorController
     */
    private $participDirectorController;

    /**
     * @Inject
     * @var VacancyResponseController
     */
    private $vacancyResponseCotnroller;

    /**
     * @Inject
     * @var SchoolController
     */
    private $schoolController;

    /**
     * VacancyController constructor.
     * @param VacancyRepository $repository
     */
    public function __construct(VacancyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBySorting()
    {
        $areaCode = $_GET['ac'] ? $_GET['ac'] : 0;
        $schoolId = $_GET['schid'] ? $_GET['schid'] : 0;
        $doljnostId = $_GET['pid'] ? $_GET['pid'] : 0;
        $payment['min'] = $_GET['pmin'] ? $_GET['pmin'] : 0;
        $payment['max'] = $_GET['pmax'] ? $_GET['pmax'] : 0;
        if ($payment['min'] == 0 && $payment['max'] == 0) {
            $payment['min'] = 'no';
            $payment['max'] = 'no';
        }
        $stajId = $_GET['staid'] ? $_GET['staid'] : 0;
        $offset = $_GET['page'] ? $_GET['page'] : 0;

        return json_encode(
            $this->repository->findBySorting(
                $areaCode,
                $schoolId,
                $doljnostId,
                $payment,
                $stajId,
                $offset * 9
            )
        );
    }

    public function getBySchool(): string
    {
        $schoolId = 0;
        if ($this->inputHandler->exists('schid')) {
            $schoolId = $this->inputHandler->get('schid', 0);
        }
        if (!empty($_SESSION['id'])) {
            $schoolId = json_decode($this->participDirectorController->getById(), true)['schoolid'];
        }
        if ($schoolId != 0) {
            SimpleRouter::response()->header('Content-Type: application/json');
            $vacancies = $this->repository->findBySchoolId($schoolId);
            foreach ($vacancies as &$vacancy) {
                $resps = json_decode($this->vacancyResponseCotnroller->getByVacancy($vacancy['id']), true);
                $vacancy['resp'] = $resps;
            }

            return json_encode($vacancies, 0, 8);
        }

        return $this->BadRequest();
    }

    public function deleteVacancy()
    {
        $id = $this->inputHandler->post('id', 0);
        if ($id != 0) {
            $this->repository->delete($id);
            SimpleRouter::response()->httpCode(200);

            return $id;
        }

        return $this->BadRequest();
    }

    public function postVacancy()
    {
        try {
            if (!$director
                = json_decode(
                $this->participDirectorController->getById(),
                true,
                512
            )
            ) {
                return $this->BadRequest(
                    401,
                    'Пожалуйста зайдите в свой личный кабинет или зарегестрируйтесь'
                );
            }
        } catch (Exception $e) {
            return $this->BadRequest(400, $e->getMessage());
        }
        try {
            if (!$school = json_decode($this->schoolController->getById($director['schoolid']), true, 512)) {
                return $this->BadRequest(
                    400,
                    'В вашем личном кабинете не установлена школа'
                );
            }
        } catch (Exception $e) {
            return $this->BadRequest(400, $e->getMessage());
        }
        $doljnostid = $this->inputHandler->post('pid', 0);
        if ($this->vacancyExists($doljnostid, $school['id'])) {
            return $this->BadRequest(400, 'Данная вакансия уже существует');
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
                $vacancy = $this->repository->saveVacancy(
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
                return $this->BadRequest(400, $e->getMessage());
            }
        }

        return $this->BadRequest();
    }

    public function vacancyExists($doljnostId = 0, $schoolId = 0): bool
    {
        if ($schoolId == 0 && $doljnostId == 0) {
            return false;
        }
        if ($this->repository->countOfVacanciesWith($doljnostId, $schoolId) > 0) {
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
            $vacancy = $this->repository->updateVacancy($id, $doljnostid, $zp, $stajId, $dopInfo);
            $vacancy['resp'] = [];
            return json_encode($vacancy, JSON_PRETTY_PRINT, 512);
        }
        return $this->BadRequest();
    }
}
