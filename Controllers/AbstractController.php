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

	protected function BadRequest(int $code = 400, string $message = 'Bad request'): string
	{
		SimpleRouter::response()->httpCode($code);

		return $message;
	}
}
