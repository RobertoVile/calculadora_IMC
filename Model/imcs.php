<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;

class Imcs {

    private $db;

    public function __construct() {
        $this->db = Connection::getInstance();
    }

    public function createImcs($weight, $height, $result): bool|string {
        try {
            $sql = "INSERT INTO imcs (weight, height, result, created_at) VALUES (:weight, :height, :result, NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":weight", $weight, PDO::PARAM_STR);
            $stmt->bindParam(":height", $height, PDO::PARAM_STR);
            $stmt->bindParam(":result", $result, PDO::PARAM_STR);
           
            $executed = $stmt->execute();

            if ($executed) {
                return true;
            } else {
                echo "Erro na criação do IMC";
                return false;
            }
        } catch (PDOException $error) {
            return "Erro de criação: " . $error->getMessage();
        }
    }
}
