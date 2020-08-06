<?php

declare(strict_types=1);

namespace App\Middleware;


use App\Core\Routes;
use App\Domain\UserRoles;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

class AuthMiddleware implements IMiddleware
{

    use AuthenticatedUserDataTrait;
    /**
     * {@inheritDoc}
     */
    public function handle(Request $request): void
    {
        $request->user = $this->getAuthenticatedUser();
        if ($request->user === null || ($request->user->type !== UserRoles::DIRECTOR && $request->user->type !== UserRoles::TEACHER)) {
            SimpleRouter::response()->redirect(Routes::BASE_ROUTE, 301);
        }
    }
}