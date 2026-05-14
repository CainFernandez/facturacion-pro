<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Models\Role;
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

        $roleModel = new Role();

        $roles = $roleModel->getAll();

        return $this->view(
            'users/create',
            [
                'roles' => $roles
            ]
        );
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
        $roleId = (int) ($_POST['role_id'] ?? 0);

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
            'role_id' => $roleId
        ]);

        header('Location: /facturacion-pro/public/users');
        exit;
    }
}
