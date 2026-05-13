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
}
