<?php

use Core\Router;

/** @var Router $router */

$router->get('/', 'AuthController@login');
$router->get('/dashboard', 'HomeController@index');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate');
$router->get('/logout', 'AuthController@logout');

//Rutas para la gestión de usuarios
$router->get('/users', 'UserController@index');
$router->get('/users/create', 'UserController@create');
$router->post('/users/store', 'UserController@store');
$router->get('/users/edit', 'UserController@edit');
$router->post('/users/update', 'UserController@update');
