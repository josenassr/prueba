<?php

namespace Database\Migrations;

use App\Models\Database;

class CreateDatabase {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Inicializa la conexión a la base de datos
    }

    public function up() {
        try {
            $config = $this->db->getConfig(); // Obtener configuración
            $pdo = $this->db->getConnection(); // Obtener conexión existente
            
            // Establecer la codificación de caracteres a UTF-8
            $pdo->exec("SET NAMES 'utf8'");
            $pdo->exec("CREATE DATABASE IF NOT EXISTS {$config['database']} CHARACTER SET utf8 COLLATE utf8_general_ci");
            echo "Base de datos '{$config['database']}' creada con éxito.\n";
        } catch (\PDOException $e) {
            throw new DatabaseException("Error al crear la base de datos: " . $e->getMessage());
        }
    }

    public function down() {
        try {
            $config = $this->db->getConfig(); // Obtener configuración
            $pdo = $this->db->getConnection(); // Obtener conexión existente
            
            $pdo->exec("DROP DATABASE IF EXISTS {$config['database']}");
            echo "Base de datos '{$config['database']}' eliminada con éxito.\n";
        } catch (\PDOException $e) {
            throw new DatabaseException("Error al eliminar la base de datos: " . $e->getMessage());
        }
    }
}

?>