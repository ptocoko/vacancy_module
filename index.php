<?php

declare(strict_types=1);

use App\Config\Routes;
use DI\ContainerBuilder;
use Pecee\SimpleRouter\SimpleRouter;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Config/settings.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');
$container = (new ContainerBuilder())
        ->useAutowiring(true)
        ->useAnnotations(true)
        ->enableCompilation(__DIR__ . '/var/cache')
        ->writeProxiesToFile(true, __DIR__ . '/var/cache')
        ->build();
SimpleRouter::enableDependencyInjection($container);
SimpleRouter::setDefaultNamespace('App\Controllers');

SimpleRouter::group(
        ['prefix' => Routes::BASE_ROUTE],
        static function () {
            SimpleRouter::group(
                    ['prefix' => Routes::AREAS_ROUTE],
                    static function () {
                        /**
                         * @see AreaController::getAll()
                         */
                        SimpleRouter::get('/', 'AreaController@getAll');
                        /**
                         * @see AreaController::getByCode()
                         */
                        SimpleRouter::get('/{code}', 'AreaController@getByCode')->where(['code' => '[0-9]+']);
                        /**
                         * @see AreaController::getSchoolsByArea()
                         */
                        SimpleRouter::get('/{code}/schools', 'AreaController@getSchoolsByArea')->where(
                                ['code' => '[0-9]+']
                        );
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::VACANCY_ROUTE],
                    static function () {
                        /**
                         * @see VacancyController::getSortedData()
                         */
                        SimpleRouter::get('/getbysorting', 'VacancyController@getSortedData');

                        SimpleRouter::group(
                                ['middleware' => \App\Middleware\AuthMiddleware::class],
                                static function () {
                                    /**
                                     * @see VacancyController::postVacancy()
                                     */
                                    SimpleRouter::post('/', 'VacancyController@postVacancy');
                                    /**
                                     * @see VacancyController::getBySchool()
                                     */
                                    SimpleRouter::get('/getbyschool', 'VacancyController@getBySchool');
                                    /**
                                     * @see VacancyController::updateVacancy()
                                     */
                                    SimpleRouter::patch('/', 'VacancyController@updateVacancy');
                                    /**
                                     * @see VacancyController::deleteVacancy()
                                     */
                                    SimpleRouter::delete('/{id}', 'VacancyController@deleteVacancy')->where(
                                            ['code' => '[0-9]+']
                                    );
                                }
                        );
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::VACANCY_RESPONSE_ROUTE],
                    static function () {
                        /**
                         * @see VacancyResponseController::getByVacancy()
                         */
                        SimpleRouter::get('/{vacancyid}', 'VacancyResponseController@getByVacancy')->where(
                                ['vacancyid' => '[0-9]+']
                        );
                        /**
                         * @see VacancyResponseController::post()
                         */
                        SimpleRouter::post('/', 'VacancyResponseController@post');
                        /**
                         * @see VacancyResponseController::delete()
                         */
                        SimpleRouter::delete('/{id}', 'VacancyResponseController@delete')->where(
                                ['id' => '[0-9]+']
                        );
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::SCHOOLS_ROUTE],
                    static function () {
                        /**
                         * @see SchoolController::getAll()
                         */
                        SimpleRouter::get('/', 'SchoolController@getAll');
                        /**
                         * @see SchoolController::getById()
                         */
                        SimpleRouter::get('/{id}', 'SchoolController@getById')->where(['id' => '[0-9]+']);
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::POSITION_ROUTE],
                    static function () {
                        /**
                         * @see PositionController::getAll()
                         */
                        SimpleRouter::get('/', 'PositionController@getAll');
                    }
            );

            SimpleRouter::get('/', 'IndexController@index');
        }
);

SimpleRouter::start();
