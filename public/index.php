<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

// Crear router
$router = new Router();

// Cargar rutas
require_once __DIR__ . '/../routes/web.php';

// Ejecutar
$router->dispatch($_SERVER['REQUEST_URI']);