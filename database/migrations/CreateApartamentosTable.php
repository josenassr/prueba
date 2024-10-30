<?php

namespace Database\Migrations;

use App\Exceptions\DatabaseException;
use App\Models\Database;

class CreateApartamentosTable {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Inicializa la conexión a la base de datos
        $config = $this->db->getConfig();
        
        // Conectar a la base de datos específica con la codificación UTF-8
        $this->db->connectToDatabase($config['database']);
    }

    public function up() {
        try {
            $pdo = $this->db->getConnection(); // Obtener conexión a la base de datos

            // Establecer la codificación de caracteres a UTF-8
            $pdo->exec("SET NAMES 'utf8'");

            // Crear la tabla si no existe con la codificación UTF-8
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS apartamentos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(255) NOT NULL,
                    apartamentos_disponibles INT NOT NULL,
                    capacidad_adultos INT NOT NULL,
                    ciudad VARCHAR(255) NOT NULL,
                    provincia VARCHAR(255) NOT NULL
                ) CHARACTER SET utf8 COLLATE utf8_general_ci
            ");
            echo "Tabla 'apartamentos' creada con éxito.\n";
        } catch (\PDOException $e) {
            throw new DatabaseException("Error al crear la tabla: " . $e->getMessage());
        }
    }

    public function down() {
        try {
            $pdo = $this->db->getConnection(); // Obtener conexión a la base de datos
            
            // Eliminar la tabla si existe
            $pdo->exec("DROP TABLE IF EXISTS apartamentos");
            echo "Tabla 'apartamentos' eliminada con éxito.\n";
        } catch (\PDOException $e) {
            throw new DatabaseException("Error al eliminar la tabla: " . $e->getMessage());
        }
    }
}

?>