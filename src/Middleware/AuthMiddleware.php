<?php

declare(strict_types=1);

namespace App\Middleware;


//class AuthMiddleware implements IMiddleware
//{
//
//
////    /**
////     * {@inheritDoc}
////     */
////    public function handle(Request $request): void
////    {
////        $request->user = User::authenticate();
////        if ($request->user === null) {
////            $request->setRewriteCallback('IndexController@index');
////        }
////    }
//}