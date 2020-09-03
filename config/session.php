<?php

return [
    'driver'          => 'file',
    'lifetime'        => 120,
    'expire_on_close' => false,
    'files'           => storage_path('framework/sessions'),
    'connection'      => env('SESSION_CONNECTION', null),
    'store'           => env('SESSION_STORE', null),
    'lottery'         => [2, 100],
    'cookie'          => 'session',
    'path'            => '/',
    'domain'          => null,
    'http_only'       => true,
];
