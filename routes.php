<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () {
    return view('index');
});
