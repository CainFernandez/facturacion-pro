<?php

namespace App\Controllers;

use Core\Controller;
use App\Middlewares\AuthMiddleware;

class UserController extends Controller
{

    public function index()
    {

        // 🔒 proteger módulo
        AuthMiddleware::handle();

        return $this->view('users/index');
    }
}
