<?php


namespace App\Core;


use App\Controllers\IndexController;
use App\Controllers\RsurTestController;
use App\Controllers\VacancyController;
use App\Controllers\VacancyResponseController;
use App\Middleware\ApiMiddleWare;
use App\Middleware\AuthMiddleware;
use App\Middleware\DirectorAuthMiddleWare;
use App\Middleware\TeacherAuthMiddleWare;
use DI\ContainerBuilder;
use Pecee\SimpleRouter\SimpleRouter;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

class Routes
{
    public const BASE_ROUTE = '/';
    public const AREAS_ROUTE = 'areas';
    public const SCHOOLS_ROUTE = 'schools';
    public const VACANCY_ROUTE = 'vacancies';
    public const VACANCY_RESPONSE_ROUTE = 'vacancy_responses';
    public const POSITION_ROUTE = 'positions';
    public const NOT_FOUND = 'not_found';

    public static function init(): void
    {
        self::config();
        self::setRoutes();
//        try {
        SimpleRouter::start();
//        } catch (TokenMismatchException $e) {
//            SimpleRouter::response()->redirect(self::NOT_FOUND);
//        } catch (NotFoundHttpException $e) {
//            SimpleRouter::response()->redirect(self::NOT_FOUND);
//        } catch (HttpException $e) {
//            SimpleRouter::response()->redirect(self::NOT_FOUND);
//        }
    }

    private static function config(): void
    {
        $container = (new ContainerBuilder())
                ->useAutowiring(true)
                ->useAnnotations(true)
                ->enableCompilation(dirname(__DIR__, 2) . '/var/cache')
                ->writeProxiesToFile(true, dirname(__DIR__, 2) . '/var/cache')
                ->build();
        $container->set(LoaderInterface::class, new FilesystemLoader(dirname(__DIR__, 2) . '/public/'));
        SimpleRouter::enableDependencyInjection($container);
        SimpleRouter::setDefaultNamespace('App\Controllers');
    }

    private static function setRoutes(): void
    {
        SimpleRouter::partialGroup(
                self::BASE_ROUTE,
                static function () {

                    self::setApiRoutes();

                    /**
                     * @see IndexController::index()
                     */
                    SimpleRouter::get('/teacher', 'IndexController@teacher');

                    /**
                     * @see IndexController::index()
                     */
                    SimpleRouter::get(
                            '/director',
                            'IndexController@director',
                            ['middleware' => DirectorAuthMiddleWare::class]
                    );

                    /**
                     * @see VacancyResponseController::showUsersResponses()
                     */
                    SimpleRouter::get(
                            '/teacher/' . self::VACANCY_RESPONSE_ROUTE,
                            'VacancyResponseController@showUsersResponses',
                            ['middleware' => TeacherAuthMiddleWare::class]
                    );

                    /**
                     * @see VacancyResponseController::getDialog()
                     */
                    SimpleRouter::get(
                            self::VACANCY_RESPONSE_ROUTE . '/{responseid}/dialog',
                            'VacancyResponseController@getDialog',
                            ['middleware' => AuthMiddleware::class]
                    )->where(['responseid' => '[0-9]+']);

                    /**
                     * @see IndexController
                     */
                    SimpleRouter::get('/', 'IndexController@index');
                    SimpleRouter::post('/', 'IndexController@login');
                    SimpleRouter::get(self::NOT_FOUND, 'IndexController@notFound');
                    /**
                     * @see RsurTestController::getTestsWithSubjects()
                     */
                    SimpleRouter::get('/tests', 'RsurTestController@getTestsWithSubjects');
                }
        );
    }

    private static function setApiRoutes(): void
    {
        SimpleRouter::group(
                ['middleware' => ApiMiddleWare::class],
                static function () {
                    /**
                     * Areas group
                     */
                    SimpleRouter::partialGroup(
                            self::AREAS_ROUTE,
                            static function () {
                                /**
                                 * @see AreaController::index()
                                 */
                                SimpleRouter::get('/', 'AreaController@index');
                                /**
                                 * @see AreaController::show()
                                 */
                                SimpleRouter::get('/{code}', 'AreaController@show')->where(
                                        ['code' => '[0-9]+']
                                );
                                /**
                                 * @see AreaController::showSchools()
                                 */
                                SimpleRouter::get(
                                        '/{code}/schools',
                                        'AreaController@showSchools'
                                )->where(
                                        ['code' => '[0-9]+']
                                );
                            }
                    );
                    /**
                     * Schools group
                     */
                    SimpleRouter::partialGroup(
                            self::SCHOOLS_ROUTE,
                            static function () {
                                /**
                                 * @see SchoolController::index()
                                 */
                                SimpleRouter::get('/', 'SchoolController@index');
                                /**
                                 * @see SchoolController::show()
                                 */
                                SimpleRouter::get('/{id}', 'SchoolController@show')->where(
                                        ['id' => '[0-9]+']
                                );
                            }
                    );
                    /**
                     * Position group
                     */
                    SimpleRouter::partialGroup(
                            self::POSITION_ROUTE,
                            static function () {
                                /**
                                 * @see PositionController::index()
                                 */
                                SimpleRouter::get('/', 'PositionController@index');
                            }
                    );
                    /**
                     * Vacancy group
                     */
                    SimpleRouter::partialGroup(
                            self::VACANCY_ROUTE,
                            static function () {
                                /**
                                 * @see VacancyController::showSorted()
                                 */
                                SimpleRouter::get('/sort', 'VacancyController@showSorted');
                                SimpleRouter::group(
                                        ['middleware' => AuthMiddleware::class],
                                        static function () {
                                            /**
                                             * @see VacancyController::create()
                                             */
                                            SimpleRouter::post('/', 'VacancyController@create');
                                            /**
                                             * @see VacancyController::update()
                                             */
                                            SimpleRouter::patch('/{id}', 'VacancyController@update')->where(
                                                    ['code' => '[0-9]+']
                                            );
                                            /**
                                             * @see VacancyController::delete()
                                             */
                                            SimpleRouter::delete('/{id}', 'VacancyController@delete')->where(
                                                    ['code' => '[0-9]+']
                                            );
                                            /**
                                             * @see VacancyController::showBySchool()
                                             */
                                            SimpleRouter::get('/by_school', 'VacancyController@showBySchool');
                                            /**
                                             * @see VacancyController::showResponses()
                                             */
                                            SimpleRouter::get(
                                                    '/{id}/responses',
                                                    'VacancyController@showResponses'
                                            )->where(
                                                    ['id' => '[0-9]+']
                                            );
                                        }
                                );
                            }
                    );
                    /**
                     * Responses group
                     */
                    SimpleRouter::group(
                            [
                                    'prefix' => self::VACANCY_RESPONSE_ROUTE,

                            ],
                            static function () {
                                /**
                                 * @see VacancyResponseController::create()
                                 */
                                SimpleRouter::post(
                                        '/',
                                        'VacancyResponseController@create',
                                        ['middleware' => TeacherAuthMiddleWare::class]
                                );

                                /**
                                 * @see VacancyResponseController::delete()
                                 */
                                SimpleRouter::delete(
                                        '/{id}',
                                        'VacancyResponseController@delete',
                                        ['middleware' => AuthMiddleware::class]
                                )->where(
                                        ['id' => '[0-9]+']
                                );
                            }
                    );
                    /**
                     * @see VacancyResponseController::accept()
                     */
                    SimpleRouter::get(
                            self::VACANCY_RESPONSE_ROUTE . '/{resposneId}/accept',
                            'VacancyResponseController@accept',
                            ['middleware' => AuthMiddleware::class]
                    )->where(['resposneId' => '[0-9]+']);
                }
        );
    }
}