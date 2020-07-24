<?php

declare(strict_types=1);

namespace App\Controllers;


use DI\Annotation\Inject;
use Pecee\Http\Input\InputHandler;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;

abstract class AbstractController
{
    /**
     * @Inject
     * @var InputHandler
     */
    protected $inputHandler;

    protected function json(array $data, int $httpResponseCode = 200): Response
    {
        SimpleRouter::response()->httpCode(200);
        SimpleRouter::response()->json($data, 0, 512);
        return SimpleRouter::response();
    }

    protected function invalidRequest(int $code = 400, string $message = 'Bad request'): Response
    {
        SimpleRouter::response()->httpCode($code);
        SimpleRouter::response()->json(['reason' => $message]);
        return SimpleRouter::response();
    }
}
