<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class AuthController extends Controller
{

    public function login()
    {
        return $this->view(
            'auth/login',
            [],
            'auth'
        );
    }

    public function authenticate()
    {

        session_start();

        // 🔑 login puede ser email o username
        $login = trim($_POST['login'] ?? '');

        $password = trim($_POST['password'] ?? '');

        // 🔍 validar campos vacíos
        if (empty($login) || empty($password)) {

            die('Todos los campos son obligatorios');
        }

        // 🔍 buscar usuario
        $userModel = new User();

        $user = $userModel->findByLogin($login);

        // ❌ usuario no encontrado
        if (!$user) {

            die('Credenciales incorrectas');
        }

        // 🚫 usuario desactivado
        if ($user['status'] !== 'active') {

            die('Usuario inactivo');
        }

        // 🔒 verificar password hash
        $passwordMatch = password_verify(
            $password,
            $user['password']
        );

        // ❌ password incorrecta
        if (!$passwordMatch) {

            die('Credenciales incorrectas');
        }

        // ✅ sesión usuario
        $_SESSION['user'] = [

            'id' => $user['id'],

            'name' => $user['name'],

            'username' => $user['username'],

            'email' => $user['email'],

            'role' => $user['role']
        ];

        header(
            'Location: /facturacion-pro/public/dashboard'
        );

        exit;
    }
}
