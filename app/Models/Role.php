<?php

namespace App\Models;

use Core\Database;
use PDO;

class Role
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Obtener todos los roles
     */
    public function getAll()
    {
        $sql = "
            SELECT
                id,
                name,
                description
            FROM roles
            ORDER BY id ASC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
