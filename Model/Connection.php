<?php
namespace Model;

use PDO;
use PDOException;

class Connection {
    public static function getConnection() {
        try {
            $conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT,
                DB_USER,
                DB_PASSWORD
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die(json_encode(["erro" => "Falha na conexão: " . $e->getMessage()]));
        }
    }
}
?>