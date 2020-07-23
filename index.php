<?php

use App\Config\Routes;
use DI\ContainerBuilder;
use Pecee\SimpleRouter\SimpleRouter;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Config/settings.php';

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
        function () {
            /**
             * @see \App\Controllers\AreaController
             */
            SimpleRouter::get('/areas', 'AreaController@getAll');
            SimpleRouter::get('/areas/{code}', 'AreaController@getByCode')->where(['code' => '[0-9]']);
            SimpleRouter::group(
                    ['prefix' => Routes::VACANCY_ROUTE],
                    function () {
                        SimpleRouter::get('/getbysorting', 'VacancyController@getBySorting');
                        SimpleRouter::post('/post', 'VacancyController@postVacancy');
                        SimpleRouter::get('/getbyschool', 'VacancyController@getBySchool');
                        SimpleRouter::post('/update', 'VacancyController@updateVacancy');
                        SimpleRouter::post('/delete', 'VacancyController@deleteVacancy');
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::VACANCY_RESPONSE_ROUTE],
                    function () {
                        SimpleRouter::get('/getbyvacancyid', 'VacancyResponseController@getByVacancy');
                        SimpleRouter::post('/postresponse', 'VacancyResponseController@postResponse');
                        SimpleRouter::post('/delete', 'VacancyResponseController@deleteResponse');
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::SCHOOLS_ROUTE],
                    function () {
                        SimpleRouter::get('/', 'SchoolController@getAll');
                        SimpleRouter::get('/getbyareacode', 'SchoolController@getByAreaCode');
                        SimpleRouter::get('/getbyid', 'SchoolController@getById');
                    }
            );
            SimpleRouter::group(
                    ['prefix' => Routes::POSITION_ROUTE],
                    function () {
                        SimpleRouter::get('/getall', 'DoljonostController@getAll');
                    }
            );
            SimpleRouter::get('/', 'IndexController@index');
        }
);

try {
    SimpleRouter::start();
} catch (Exception $e) {
}
