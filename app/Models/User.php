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
                id,
                name,
                username,
                email,
                password,
                role,
                status
            FROM users
            WHERE (
                email = :login
                OR username = :login
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
            id,
            name,
            username,
            email,
            role,
            status,
            created_at
        FROM users
        ORDER BY id DESC
    ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
