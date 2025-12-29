<?php

class Database
{
    private $con;
    private static $instance = null;

    private $host = "localhost";
    private $user = "root";
    private $pass = "abcdef2020";
    private $db = "OmonteJeremiasFinal";

    public function __construct()
    {
        $this->con = null;

        try {
            $dsn = "mysql:host=$this->host;db=$this->db";
            $this->con = new PDO($dsn, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa";
        } catch (PDOException $e) {
            throw new Exception("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }

    public function getCon()
    {
        return $this->con;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
