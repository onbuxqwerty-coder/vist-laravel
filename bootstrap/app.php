<?php

/* Файл: bootstrap/app.php */

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
        // Реєстрація псевдонімів для ваших мідлварів
        $middleware->alias([
            'admin.ip'   => \App\Http\Middleware\CheckIPAccess::class,
            'admin.auth' => \App\Http\Middleware\AdminAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();