<?php

namespace App\Models;
use App\Models\Hospedaje;

class Apartamento extends Hospedaje {
    private $apartamentos_disponibles;
    private $capacidad_adultos;

    public function __construct($nombre, $apartamentos_disponibles, $capacidad_adultos, $ciudad, $provincia) {
        parent::__construct($nombre, $ciudad, $provincia);
        $this->apartamentos_disponibles = $apartamentos_disponibles;
        $this->capacidad_adultos = $capacidad_adultos;
    }

    public function getApartamentosDisponibles() {
        return $this->apartamentos_disponibles;
    }

    public function getCapacidadAdultos() {
        return $this->capacidad_adultos;
    }

    public function getDetalles() {
        return "{$this->getNombre()}, {$this->apartamentos_disponibles} apartamentos, {$this->capacidad_adultos} adultos, {$this->getCiudad()}, {$this->getProvincia()}";
    }
}
?>