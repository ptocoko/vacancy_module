<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Config\Routes;
use Pecee\SimpleRouter\SimpleRouter;

class IndexController extends AbstractController
{
    public function index(): void
    {
        if ($_SESSION['work'] == 2 || $_SESSION['work'] == 6) {
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE . '/public/director_side.php');
        } else {
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE . '/public/teacher_side.php');
        }
    }
}
