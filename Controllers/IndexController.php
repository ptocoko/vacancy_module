<?php


namespace App\Controllers;


use App\Config\Routes;
use Pecee\SimpleRouter\SimpleRouter;

class IndexController extends AbstractController
{
    public function Index()
    {
        if ($_SESSION['work'] == 2 || $_SESSION['work'] == 6) {
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE . '/public/director_side.php');
            return;
        }
        SimpleRouter::response()->redirect(Routes::BASE_ROUTE . '/public/teacher_side.php');
        return;
    }
}
