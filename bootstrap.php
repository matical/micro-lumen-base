<?php

use Laravel\Lumen\Application;
use Illuminate\Session\SessionManager;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Session\Middleware\StartSession;

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(__DIR__))->bootstrap();
$app = new Application(__DIR__);
$app->configure('app');
$app->withFacades();
$app->withEloquent();
$app->middleware([StartSession::class]);

$app->singleton(SessionManager::class, function () use ($app) {
    return $app->loadComponent('session', SessionServiceProvider::class, 'session');
});

$app->singleton('session.store', function () use ($app) {
    return $app->loadComponent('session', SessionServiceProvider::class, 'session.store');
});

/**
 * @param array|string|null $key
 * @param mixed             $default
 * @return mixed|\Illuminate\Session\Store|\Illuminate\Session\SessionManager
 */
function session($key = null, $default = null)
{
    if ($key === null) {
        return app('session');
    }

    if (is_array($key)) {
        return app('session')->put($key);
    }

    return app('session')->get($key, $default);
}

function old($key = null)
{
    return session()->getOldInput($key);
}


$router = $app->router;
require_once __DIR__ . '/routes.php';

return $app;
