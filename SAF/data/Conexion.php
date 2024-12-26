<?php

class Conexion {

    private $dsn = "mysql:host=localhost;dbname=bdsaf";
    private $username = "root";
    private $password = "";

    function connect(): PDO {
        try {
            $conn = new PDO($this->dsn, $this->username, $this->password);
            // Establecer el modo de error de PDO a excepción
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
