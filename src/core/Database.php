<?php

class Database
{
    private $host = "db"; 
    private $db_name = "proyecto_educacion";
    private $username = "postgres";
    private $password = "postgres";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            // 👇 Cambia el DSN (mysql → pgsql)
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

            // Configuración adicional para errores y UTF8
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES 'UTF8'");
        } catch (PDOException $exception) {
            echo " Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
