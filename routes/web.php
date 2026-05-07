<?php

use Core\Router;

/** @var Router $router */

$router->get('/', 'HomeController@index');
$router->get('/login', 'AuthController@login');