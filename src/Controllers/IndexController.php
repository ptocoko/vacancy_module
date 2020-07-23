<?php

declare(strict_types=1);

namespace App\Controllers;


use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;

class IndexController extends AbstractController
{
    public function index(): Response
    {
        if ($_SESSION['work'] == 2 || $_SESSION['work'] == 6) {
            SimpleRouter::response()->redirect('http://vacancy.test/public/director_side.php');
            return SimpleRouter::response();
        } else {
            SimpleRouter::response()->redirect('http://vacancy.test/public/teacher_side.php');
            return SimpleRouter::response();
        }
    }
}
