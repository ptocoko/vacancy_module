<?php

declare(strict_types=1);

namespace App\Middleware;


use App\Config\Routes;
use App\Domain\UserRoles;
use App\Repository\ParticipantDirectorRepository;
use DI\Annotation\Inject;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

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

        if ($request->user === null || ($request->user->type !== UserRoles::DIRECTOR && $request->user->type !== UserRoles::TEACHER)) {
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE, 301);
            die();
        }
    }
}