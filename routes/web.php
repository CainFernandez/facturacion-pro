<?php

use Core\Router;

/** @var Router $router */

$router->get('/', 'AuthController@login');
$router->get('/dashboard', 'HomeController@index');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate');
