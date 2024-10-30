<?php

namespace App\Models;
use App\Models\Hospedaje;
class Hotel extends Hospedaje {
    private $estrellas;
    private $tipo_habitacion;

    public function __construct($nombre, $estrellas, $tipo_habitacion, $ciudad, $provincia) {
        parent::__construct($nombre, $ciudad, $provincia);
        $this->estrellas = $estrellas;
        $this->tipo_habitacion = $tipo_habitacion;
    }

    public function getEstrellas() {
        return $this->estrellas;
    }

    public function getTipoHabitacion() {
        return $this->tipo_habitacion;
    }

    public function getDetalles() {
        return "{$this->getNombre()}, {$this->estrellas} estrellas, habitación {$this->tipo_habitacion}, {$this->getCiudad()}, {$this->getProvincia()}";
    }
}
?>