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
     * 🔍 Buscar usuario por email o username login.
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
     * 🔍 Buscar usuarios
     */
    public function search(string $search): array
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
        WHERE
            u.name LIKE :search
            OR u.username LIKE :search
            OR u.email LIKE :search
        ORDER BY u.id DESC
    ";

        return $this->db
            ->query($sql, [
                ':search' => '%' . $search . '%'
            ])
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

    /**
     * ---Editar usuario---
     */

    /**
     * ✏️ Buscar usuario por ID
     */
    public function findById(int $id): ?array
    {
        $sql = "
        SELECT
            u.id,
            u.name,
            u.username,
            u.email,
            u.role_id,
            r.description AS role_name,
            u.status
        FROM users u
        INNER JOIN roles r ON r.id = u.role_id
        WHERE u.id = :id
        LIMIT 1
    ";

        $user = $this->db
            ->query($sql, [
                ':id' => $id
            ])
            ->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * ✏️ Actualizar usuario
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
        UPDATE users
        SET
            name = :name,
            username = :username,
            email = :email,
            role_id = :role_id
        WHERE id = :id
    ";

        $this->db->query($sql, [
            ':name'     => $data['name'],
            ':username' => $data['username'],
            ':email'    => $data['email'],
            ':role_id'  => $data['role_id'],
            ':id'       => $id
        ]);

        return true;
    }

    /**
     * 🔄 Activar / Desactivar usuario
     */
    public function toggleStatus(int $id, string $status): bool
    {
        $sql = "
        UPDATE users
        SET status = :status
        WHERE id = :id
    ";

        $this->db->query($sql, [
            ':status' => $status,
            ':id'     => $id
        ]);

        return true;
    }
}
