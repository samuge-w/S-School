<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'super_admin' => \App\Http\Middleware\SuperAdmin::class,
            'checkPermission' => \App\Http\Middleware\CheckPermission::class,
            'check.license' => \App\Http\Middleware\CheckLicense::class,
            'set.locale' => \App\Http\Middleware\SetLocale::class,
            'activity' => \jeremykenedy\LaravelLogger\App\Http\Middleware\LogActivity::class,
        ]);

        // Ensure locale is set on every web request after the session starts
        $middleware->web(append: ['set.locale']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
