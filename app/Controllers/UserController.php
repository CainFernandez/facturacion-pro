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
                'users' => $users,
                'page'  => 'users'
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
                'roles' => $roles,
                'page' => 'users-create'
            ]
        );
    }
    /**
     * Mostrar formulario editar usuario
     */
    public function edit()
    {
        AuthMiddleware::handle();

        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            header('Location: /facturacion-pro/public/users');
            exit;
        }

        $userModel = new User();

        $user = $userModel->findById($id);

        if (!$user) {
            header('Location: /facturacion-pro/public/users');
            exit;
        }

        $roleModel = new Role();

        $roles = $roleModel->getAll();

        return $this->view(
            'users/edit',
            [
                'user'  => $user,
                'roles' => $roles,
                'page' => 'users-edit'
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
                'password'  => $password,
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
     * Actualizar usuario
     */
    public function update()
    {
        AuthMiddleware::handle();

        // Detectar AJAX
        $isAjax = (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );

        $id       = (int) ($_POST['id'] ?? 0);
        $name     = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $roleId   = (int) ($_POST['role_id'] ?? 0);

        // Validación básica
        if (
            $id <= 0 ||
            empty($name) ||
            empty($username) ||
            empty($email) ||
            $roleId <= 0
        ) {
            return $this->respond(
                $isAjax,
                false,
                'Todos los campos son obligatorios'
            );
        }

        $userModel = new User();

        try {

            // Verificar que el usuario exista
            $user = $userModel->findById($id);

            if (!$user) {
                return $this->respond(
                    $isAjax,
                    false,
                    'El usuario no existe'
                );
            }

            // Actualizar usuario
            $userModel->update(
                $id,
                [
                    'name'     => $name,
                    'username' => $username,
                    'email'    => $email,
                    'role_id'  => $roleId
                ]
            );

            return $this->respond(
                $isAjax,
                true,
                'Usuario actualizado correctamente'
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

            return $this->respond(
                $isAjax,
                false,
                'Error interno al actualizar usuario'
            );
        }
    }

    /**
     * 🔄 Activar / Desactivar usuario
     */
    public function toggleStatus()
    {
        AuthMiddleware::handle();

        // Detectar AJAX
        $isAjax = (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );

        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0) {
            return $this->respond(
                $isAjax,
                false,
                'ID de usuario inválido'
            );
        }

        $userModel = new User();

        try {

            // Buscar usuario
            $user = $userModel->findById($id);

            if (!$user) {
                return $this->respond(
                    $isAjax,
                    false,
                    'El usuario no existe'
                );
            }

            // Determinar nuevo estado
            $newStatus =
                $user['status'] === 'active'
                ? 'inactive'
                : 'active';

            // Actualizar estado
            $userModel->toggleStatus(
                $id,
                $newStatus
            );

            $message =
                $newStatus === 'active'
                ? 'Usuario activado correctamente'
                : 'Usuario desactivado correctamente';

            return $this->respond(
                $isAjax,
                true,
                $message
            );
        } catch (PDOException $e) {

            return $this->respond(
                $isAjax,
                false,
                'Error interno al cambiar el estado del usuario'
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
