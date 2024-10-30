<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Hotel;
use App\Models\Apartamento;
use App\Exceptions\DatabaseException;
use App\Exceptions\InvalidArgumentException;

class HospedajeController {
    private Database $db;

    public function __construct() {
        $this->db = new Database(); 
        $config = $this->db->getConfig();
        
        $this->db->connectToDatabase($config['database']);
    }

    public function buscarHospedajes(string $prefix): array {
        if (strlen($prefix) < 3) {
            throw new InvalidArgumentException("El prefijo debe tener al menos 3 caracteres.");
        }

        $prefix = '%' . $prefix . '%';
        $resultados = [];

        try {
            $resultados = array_merge($this->buscarHoteles($prefix), $this->buscarApartamentos($prefix));
        } catch (\PDOException $e) {
            throw new DatabaseException("Error al buscar hospedajes: " . $e->getMessage());
        }
        return $resultados;
    }

    private function buscarHoteles(string $prefix): array {
        $resultados = [];
        $hoteles = $this->db->getConnection()->prepare("SELECT nombre, estrellas, tipo_habitacion, ciudad, provincia FROM hoteles WHERE nombre LIKE ?");
        $hoteles->execute([$prefix]);

        while ($row = $hoteles->fetch(\PDO::FETCH_ASSOC)) {
            $resultados[] = new Hotel($row['nombre'], $row['estrellas'], $row['tipo_habitacion'], $row['ciudad'], $row['provincia']);
        }

        return $resultados;
    }

    private function buscarApartamentos(string $prefix): array {
        $resultados = [];
        $apartamentos = $this->db->getConnection()->prepare("SELECT nombre, apartamentos_disponibles, capacidad_adultos, ciudad, provincia FROM apartamentos WHERE nombre LIKE ?");
        $apartamentos->execute([$prefix]);

        while ($row = $apartamentos->fetch(\PDO::FETCH_ASSOC)) {
            $resultados[] = new Apartamento($row['nombre'], $row['apartamentos_disponibles'], $row['capacidad_adultos'], $row['ciudad'], $row['provincia']);
        }

        return $resultados;
    }

    
}

?>