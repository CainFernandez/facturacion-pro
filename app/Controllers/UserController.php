<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Middlewares\AuthMiddleware;

class UserController extends Controller
{
    public function index()
    {
        // 🔒 proteger módulo
        AuthMiddleware::handle();

        // Obtener usuarios desde BD
        $userModel = new User();

        $users = $userModel->getAll();

        return $this->view(
            'users/index',
            [
                'users' => $users
            ]
        );
    }

    /**
     * Mostrar formulario crear usuario
     */
    public function create()
    {
        AuthMiddleware::handle();

        return $this->view('users/create');
    }

    /**
     * Guardar usuario nuevo
     */
    public function store()
    {
        AuthMiddleware::handle();

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role = trim($_POST['role_id'] );

        // Validación básica
        if (
            empty($name) ||
            empty($username) ||
            empty($email) ||
            empty($password)
        ) {
            die('Todos los campos son obligatorios');
        }

        $userModel = new User();

        $userModel->create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => $role
        ]);

        header('Location: /facturacion-pro/public/users');
        exit;
    }
}
