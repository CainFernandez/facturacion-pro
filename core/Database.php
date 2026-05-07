<?php

namespace Core;

use PDO;
use PDOException;

class Database
{

    private $connection;

    public function __construct()
    {

        $config = require __DIR__ . '/../config/database.php';

        try {

            $this->connection = new PDO(

                "mysql:host={$config['host']};dbname={$config['dbname']}",

                $config['username'],

                $config['password']
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {

            die('Error DB: ' . $e->getMessage());
        }
    }

    // 🔍 ejecutar consultas preparadas
    public function query($sql, $params = [])
    {

        $stmt = $this->connection->prepare($sql);

        $stmt->execute($params);

        return $stmt;
    }
}
