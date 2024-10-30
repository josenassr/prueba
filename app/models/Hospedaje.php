<?php
namespace App\Models;

abstract class Hospedaje {
    protected $nombre;
    protected $ciudad;
    protected $provincia;

    public function __construct($nombre, $ciudad, $provincia) {
        $this->nombre = $nombre;
        $this->ciudad = $ciudad;
        $this->provincia = $provincia;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCiudad() {
        return $this->ciudad;
    }
    
    public function getProvincia() {
        return $this->provincia;
    }

    abstract public function getDetalles();
}
?>