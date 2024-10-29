<?php

class Database {
    static public function getConnection() {
        $host = 'localhost';
        $db_name = 'prueba_desis';
        $username = 'root';
        $password = '';
        $conn = null;
        try {
            $conn = new PDO(
                "mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8",
                $username,
                $password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $conn;
    }
}
?>
