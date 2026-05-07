<?php

namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller
{

    public function login()
    {
        return $this->view('auth/login', [], 'auth');
    }

    public function authenticate()
    {
        session_start();

        // 🔑 login puede ser email o username
        $login = $_POST['login'] ?? '';

        $password = $_POST['password'] ?? '';

        // 🔥 temporal
        if (
            $login === 'admin@test.com'
            && $password === '1234'
        ) {

            $_SESSION['user'] = $login;

            header('Location: /facturacion-pro/public/dashboard');
            exit;
        }

        echo "Credenciales incorrectas";
    }
}
