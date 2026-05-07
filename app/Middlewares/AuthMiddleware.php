<?php

namespace App\Middlewares;

class AuthMiddleware
{

    /**
     * 🔒 Verificar sesión usuario
     */
    public static function handle()
    {

        // 🚀 iniciar sesión si no existe
        if (session_status() === PHP_SESSION_NONE) {

            session_start();
        }

        // ❌ usuario no autenticado
        if (!isset($_SESSION['user'])) {

            header(
                'Location: /facturacion-pro/public/login'
            );

            exit;
        }
    }
}
