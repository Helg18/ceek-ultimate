<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\Cors::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],
        'api' => [
            'throttle:60,1',
            \App\Http\Middleware\IoLogRequestMiddleware::class,
            \App\Http\Middleware\IoLogResponseMiddleware::class,
            \App\Http\Middleware\DeviceIdRequired::class,
            \App\Http\Middleware\TokenAuthMiddleware::class,
        ],
        'api.noauth' => [
            'throttle:60,1',
            \App\Http\Middleware\IoLogRequestMiddleware::class,
            \App\Http\Middleware\IoLogResponseMiddleware::class,
            \App\Http\Middleware\DeviceIdRequired::class,
        ],
// Last middleware for Ceek must be \Ceek\Http\Middleware\CeekMidAdapterMiddleware::class,
        'ceek' => [
            'throttle:60,1',
            \App\Http\Middleware\IoLogRequestMiddleware::class,
            \App\Http\Middleware\IoLogResponseMiddleware::class,
            \App\Http\Middleware\DeviceIdRequired::class,
            \App\Http\Middleware\TokenAuthMiddleware::class,
            \Ceek\Http\Middleware\CeekMidAdapterMiddleware::class,
        ],
        'ceek.noauth' => [
            'throttle:60,1',
            \App\Http\Middleware\IoLogRequestMiddleware::class,
            \App\Http\Middleware\IoLogResponseMiddleware::class,
            \App\Http\Middleware\DeviceIdRequired::class,
            \Ceek\Http\Middleware\CeekMidAdapterMiddleware::class,
        ],
        'ceek.midonly' => [
            'throttle:60,1',
            \App\Http\Middleware\IoLogRequestMiddleware::class,
            \App\Http\Middleware\IoLogResponseMiddleware::class,
            \Ceek\Http\Middleware\CeekMidAdapterMiddleware::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'autologout' => \Ceek\Http\Middleware\AutoLogoutUserMiddleware::class,
    ];
}
