<?php

namespace Views;

use App\Models\Hotel;
use App\Models\Apartamento;
use App\Console\ConsoleTable;

class HospedajesView implements HospedajeViewInterface {

    public function render(array $hoteles, array $apartamentos): string {
        $output = "Resultados de la búsqueda:\n\n";

        if (!empty($hoteles)) {
            $output .= "Hoteles:\n";
            $output .= $this->generateTable($hoteles, 'hotel');
            $output .= "\n";
        }

        if (!empty($apartamentos)) {
            $output .= "Apartamentos:\n";
            $output .= $this->generateTable($apartamentos, 'apartamento');
            $output .= "\n";
        }

        if (empty($hoteles) && empty($apartamentos)) {
            $output .= "No se encontraron resultados de hoteles ni apartamentos.\n";
        }

        return $output;
    }

    private function generateTable(array $data, string $tipo): string {
    $headers = ['Nombre', 'Estrellas', 'Tipo de Habitación', 'Ciudad', 'Provincia'];

    $table = new ConsoleTable();
    $table->setHeaders($headers);

    foreach ($data as $item) {
        if ($tipo === 'hotel') {
            $table->addRow()
                ->addColumn($item->getNombre())
                ->addColumn($item->getEstrellas())
                ->addColumn($item->getTipoHabitacion())
                ->addColumn($item->getCiudad())
                ->addColumn($item->getProvincia());
        } else {
            $table->addRow()
                ->addColumn($item->getNombre())
                ->addColumn($item->getApartamentosDisponibles())
                ->addColumn($item->getCapacidadAdultos())
                ->addColumn($item->getCiudad())
                ->addColumn($item->getProvincia());
        }
    }

    // Return the table as a string instead of displaying it
    return $table->getTable();
}

}

?>