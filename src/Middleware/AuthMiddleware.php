<?php

declare(strict_types=1);

namespace App\Middleware;


use App\Repository\ParticipantDirectorRepository;
use DI\Annotation\Inject;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AuthMiddleware implements IMiddleware
{
    /**
     * @Inject
     * @var ParticipantDirectorRepository
     */
    private $participantDirectorRepository;

    /**
     * {@inheritDoc}
     */
    public function handle(Request $request): void
    {
        $request->user = $this->participantDirectorRepository->findById((int)$_SESSION['id']);
        if ($request->user === null) {
            $request->setRewriteCallback('IndexController@index');
        }
    }
}