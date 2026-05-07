<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{

    public function index()
    {

        session_start();

        if (!isset($_SESSION['user'])) {

            header('Location: /facturacion-pro/public/login');
            exit;
        }

        return $this->view('home');
    }
}
