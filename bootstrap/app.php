<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'company' => \App\Http\Middleware\EnsureUserBelongsToCompany::class,
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'hr' => \App\Http\Middleware\EnsureUserIsHR::class,
            'manager' => \App\Http\Middleware\EnsureUserIsManager::class,
            'employee' => \App\Http\Middleware\EnsureUserIsEmployee::class,
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
