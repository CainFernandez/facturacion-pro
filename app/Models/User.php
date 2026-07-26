<?php

namespace App\Models;

use Core\Database;
use PDO;

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * 🔍 Buscar usuario por email o username
     */
    public function findByLogin($login)
    {
        $sql = "
        SELECT
            u.id,
            u.name,
            u.username,
            u.email,
            u.password,
            u.role_id,
            r.description AS role_name,
            u.status
        FROM users u
        INNER JOIN roles r ON u.role_id = r.id
        WHERE (
            u.email = :login
            OR u.username = :login
        )
        LIMIT 1
    ";

        $stmt = $this->db->query($sql, [
            ':login' => $login
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 📋 Obtener todos los usuarios
     */
    public function getAll()
    {
        $sql = "
        SELECT
            u.id,
            u.name,
            u.username,
            u.email,
            u.role_id,
            r.description AS role_name,
            u.status,
            u.created_at
        FROM users u
        INNER JOIN roles r ON r.id = u.role_id
        ORDER BY u.id DESC
    ";

        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * ➕ Crear usuario
     */
    public function create($data)
    {
        $sql = "
        INSERT INTO users (
            name,
            username,
            email,
            password,
            role_id,
            status
        )
        VALUES (
            :name,
            :username,
            :email,
            :password,
            :role_id,
            'active'
        )
    ";

        return $this->db->query($sql, [
            ':name' => $data['name'],
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            ),
            ':role_id' => $data['role_id']
        ]);
    }
}
