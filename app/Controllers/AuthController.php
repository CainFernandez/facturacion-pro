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

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // 🔥 prueba temporal
        if ($email === 'admin@test.com' && $password === '1234') {

            $_SESSION['user'] = $email;

            header('Location: /facturacion-pro/public/dashboard');
            exit;
        }

        echo "Credenciales incorrectas";
    }
}
