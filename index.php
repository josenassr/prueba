<?php
session_start(); // Iniciar la sesión
require __DIR__ . '/vendor/autoload.php';
use App\Controllers\HospedajeController;
use Views\HospedajesView;
use App\Exceptions\InvalidArgumentException;
use App\Exceptions\DatabaseException;

$controller = new HospedajeController();
$view = new HospedajesView();

// Mensaje para solicitar la entrada del usuario
try {
    $prefix = obtenerEntradaUsuario();

    $hospedajes = $controller->buscarHospedajes($prefix);

    // Filtrar los hoteles y apartamentos
    $hoteles = array_filter($hospedajes, function($hospedaje) {
        return $hospedaje instanceof \App\Models\Hotel;
    });
    $apartamentos = array_filter($hospedajes, function($hospedaje) {
        return $hospedaje instanceof \App\Models\Apartamento;
    });

    echo $view->render($hoteles, $apartamentos);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

function obtenerEntradaUsuario()
{
    echo "Por favor, proporciona al menos tres letras del nombre del hospedaje: ";
    $handle = fopen("php://stdin", "r");
    $input = fgets($handle);
    return trim($input);
}
?>