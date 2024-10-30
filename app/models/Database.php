<?php

namespace App\Models;

use App\Exceptions\DatabaseException;
use PDO;

class Database {
    private $db_host;
    private $db_database;
    private $db_username;
    private $db_password;
    private $pdo;

    public function __construct() {
        $this->loadEnv(); // Cargar variables de entorno
        $this->connect(); // Conectar al servidor MySQL
    }

    private function loadEnv() {
        $envFile = __DIR__ . '/../../.env'; // Ruta al archivo .env
        
        if (file_exists($envFile)) {
            $lines = file($envFile);
            
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line) && strpos($line, '#') !== 0) {
                    list($key, $value) = explode('=', $line, 2);
                    // Asignar a propiedades definidas
                    if (property_exists($this, strtolower($key))) {
                        $this->{strtolower($key)} = $value; // Asignación a propiedades definidas
                    }
                }
            }
        } else {
            die("El archivo .env no existe.");
        }
    }

    // Conexión al servidor MySQL sin base de datos
    private function connect() {
        try {
            $this->pdo = new PDO("mysql:host={$this->db_host}", $this->db_username, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new DatabaseException("Error de conexión: " . $e->getMessage());
        }
    }

    // Método para conectar a una base de datos específica
    public function connectToDatabase($database) {
        try {
            $this->pdo = new PDO("mysql:host={$this->db_host};dbname={$database};charset=utf8", $this->db_username, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("set names utf8"); // Establecer la codificación de caracteres
        } catch (PDOException $e) {
            throw new DatabaseException("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    // Método que devuelve la configuración como un array
    public function getConfig() {
        return [
            'host' => $this->db_host,
            'database' => $this->db_database,
            'username' => $this->db_username,
            'password' => $this->db_password,
        ];
    }

    // Método para obtener la conexión PDO
    public function getConnection() {
        return $this->pdo; // Retorna la conexión PDO
    }
}
?>