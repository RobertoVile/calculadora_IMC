<?php

namespace Model;

use PDO;
use PDOException;

require_once __DIR__ . "/../config/Configuration.php";

class Connection
{
    private static $stmt;

    public static function getInstance(): PDO
    {
        if (empty(self::$stmt)) {
            try {
                self::$stmt = new PDO(
                    'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
                    DB_USER,
                    DB_PASSWORD
                );
                self::$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$stmt;
    }
}
?>
