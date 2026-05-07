<?php

namespace App\Controllers;

use Core\Controller;
use App\Middlewares\AuthMiddleware;

class HomeController extends Controller
{

    public function index()
    {

        // 🔒 proteger dashboard
        AuthMiddleware::handle();

        return $this->view('home');
    }
}
