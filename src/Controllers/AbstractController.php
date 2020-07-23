<?php


namespace App\Controllers;


use DI\Annotation\Inject;
use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

abstract class AbstractController
{
    /**
     * @Inject
     * @var InputHandler
     */
    protected $inputHandler;

    protected function json(array $data, int $httpResponseCode = 200)
    {
        if (!empty($data)) {
            SimpleRouter::response()->httpCode(200);
            SimpleRouter::response()->json($data, 0, 512);
            return SimpleRouter::response();
        } else {
            return $this->invalidRequest();
        }
    }

    protected function invalidRequest(int $code = 400, string $message = 'Bad request'): string
    {
        SimpleRouter::response()->httpCode($code);
        return SimpleRouter::response();
    }
}
