<?php

use App\Config\Routes;
use DI\ContainerBuilder;
use Pecee\SimpleRouter\SimpleRouter;

require __DIR__ . '\vendor\autoload.php';
require_once __DIR__ . '\config\settings.php';

try {
	$container = (new ContainerBuilder())
		->useAutowiring(true)
		->useAnnotations(true)
		->enableCompilation(__DIR__ . '/var/cache')
		->writeProxiesToFile(true, __DIR__ . '/var/cache')
		->build();
} catch (Exception $e) {
	echo $e;
}

SimpleRouter::enableDependencyInjection($container);
SimpleRouter::setDefaultNamespace('App\Controllers');
SimpleRouter::group(['prefix' => Routes::BASE_ROUTE], static function () {
	SimpleRouter::group(['prefix' => Routes::AREAS_ROUTE], static function () {
		SimpleRouter::get('/getall', 'NewAreaController@getAll');
		SimpleRouter::get('/getbycode', 'NewAreaController@getByCode');
	});
	SimpleRouter::group(['prefix' => Routes::VACANCY_ROUTE],
		static function () {
			SimpleRouter::get('/getbysorting', 'VacancyController@getBySorting');
			SimpleRouter::post('/post', 'VacancyController@postVacancy');
			SimpleRouter::get('/getbyschool', 'VacancyController@getBySchool');
			SimpleRouter::post('/update', 'VacancyController@updateVacancy');
			SimpleRouter::post('/delete', 'VacancyController@deleteVacancy');
		});
	SimpleRouter::group(['prefix' => Routes::VACANCY_RESPONSE_ROUTE],
		static function () {
			SimpleRouter::get('/getbyvacancyid', 'VacancyResponseController@getByVacancy');
			SimpleRouter::post('/postresponse', 'VacancyResponseController@postResponse');
			SimpleRouter::post('/delete', 'VacancyResponseController@deleteResponse');
		});
	SimpleRouter::group(['prefix' => Routes::SCHOOLS_ROUTE],
		static function () {
			SimpleRouter::get('/getall', 'SchoolController@getAll');
			SimpleRouter::get('/getbyareacode', 'SchoolController@getByAreaCode');
			SimpleRouter::get('/getbyid', 'SchoolController@getById');
		});
	SimpleRouter::group(['prefix' => Routes::DOLJNOST_ROUTE],
		static function () {
			SimpleRouter::get('/getall', 'DoljonostController@getAll');
		});
	SimpleRouter::get('/', 'IndexController@Index');
});

try {
	SimpleRouter::start();
} catch (Exception $e) {
	SimpleRouter::response()->httpCode(501);
	echo $e->getMessage();
}
