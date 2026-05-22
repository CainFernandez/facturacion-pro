<?php

namespace App\Middlewares;

use App\Services\AuthService;

class AuthMiddleware
{
    /**
     * 🔒 Verificar sesión de usuario
     */
    public static function handle()
    {
        // ❌ usuario no autenticado
        if (!AuthService::isLogged()) {

            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
}
