<?php

namespace App\Services;

class AuthService
{
    public static function login($user)
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role_name' => $user['role_name']
        ];
    }

    public static function logout()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }

    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function isLogged()
    {
        return isset($_SESSION['user']);
    }
}
