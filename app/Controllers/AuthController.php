<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        return $this->view('auth/login', [], 'auth');
    }

    public function authenticate()
    {
        // detectar AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        $login = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // validación básica
        if (empty($login) || empty($password)) {
            return $this->response($isAjax, false, 'Todos los campos son obligatorios');
        }

        $userModel = new User();
        $user = $userModel->findByLogin($login);

        // usuario no existe
        if (!$user) {
            return $this->response($isAjax, false, 'Usuario no encontrado');
        }

        // usuario inactivo
        if ($user['status'] !== 'active') {
            return $this->response($isAjax, false, 'Usuario inactivo');
        }

        // password incorrecta
        if (!password_verify($password, $user['password'])) {
            return $this->response($isAjax, false, 'Contraseña incorrecta');
        }

        // sesión (centralizada)
        AuthService::login($user);

        return $this->response($isAjax, true, 'Login correcto', '/dashboard');
    }

    /**
     * RESPUESTA HÍBRIDA (AJAX o normal)
     */
    private function response($isAjax, $success, $message, $redirect = null)
    {
        if ($isAjax) {
            header('Content-Type: application/json');

            echo json_encode([
                'success' => $success,
                'message' => $message,
                'redirect' => $redirect
            ]);
            exit;
        }

        if ($success && $redirect) {
            header("Location: " . BASE_URL . $redirect);
            exit;
        }

        die($message);
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        AuthService::logout();

        header("Location: " . BASE_URL . "/login");
        exit;
    }
}
