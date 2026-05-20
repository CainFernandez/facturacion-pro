<?php

namespace App\Controllers;

use PDOException;
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

        // Detectar AJAX
        $isAjax = (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );

        $name     = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $roleId   = (int) ($_POST['role_id'] ?? 0);

        // Validación básica
        if (
            empty($name) ||
            empty($username) ||
            empty($email) ||
            empty($password) ||
            $roleId <= 0
        ) {
            return $this->respond($isAjax, false, 'Todos los campos son obligatorios');
        }

        $userModel = new User();

        try {
            $userModel->create([
                'name'      => $name,
                'username'  => $username,
                'email'     => $email,
                'password'  => password_hash($password, PASSWORD_DEFAULT),
                'role_id'   => $roleId
            ]);

            // éxito
            return $this->respond(
                $isAjax,
                true,
                'Usuario creado correctamente'
            );
        } catch (PDOException $e) {

            // Error MySQL duplicate entry (UNIQUE)
            if ($e->getCode() == 23000) {
                return $this->respond(
                    $isAjax,
                    false,
                    'El usuario o correo ya existe'
                );
            }

            // Otro error
            return $this->respond(
                $isAjax,
                false,
                'Error interno al crear usuario'
            );
        }
    }


    /**
     * Respuesta híbrida:
     * AJAX => JSON
     * Normal => redirect
     */
    private function respond(bool $isAjax, bool $success, string $message)
    {
        if ($isAjax) {
            header('Content-Type: application/json');

            echo json_encode([
                'success' => $success,
                'message' => $message
            ]);
            exit;
        }

        // modo clásico MVC
        header('Location: /facturacion-pro/public/users');
        exit;
    }
}
