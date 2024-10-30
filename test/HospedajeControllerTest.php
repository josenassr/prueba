<?php
require __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Controllers\HospedajeController;
use App\Models\Database;
use App\Models\Hotel;
use App\Models\Apartamento;
use App\Exceptions\InvalidArgumentException;

class HospedajeControllerTest extends TestCase {
    private $controller;

    protected function setUp(): void {
        $this->controller = new HospedajeController();
    }

    // Tests en diferentes idiomas
    public function testBuscarHospedajesEnEspanol() {
        $resultados = $this->controller->buscarHospedajes('Hotel');
        $this->assertNotEmpty($resultados);
        $this->assertGreaterThanOrEqual(1, count($resultados)); // Debe haber al menos 1 hotel
    }

    public function testBuscarHospedajesEnIngles() {
        $resultados = $this->controller->buscarHospedajes('Hotel');
        $this->assertNotEmpty($resultados);
        $this->assertGreaterThanOrEqual(1, count($resultados)); // Debe haber al menos 1 hotel
    }

    public function testBuscarHospedajesEnFrances() {
        $resultados = $this->controller->buscarHospedajes('Hôtel');
        $this->assertNotEmpty($resultados);
        $this->assertGreaterThanOrEqual(1, count($resultados)); // Debe haber al menos 1 hotel
    }

    public function testBuscarHospedajesEnJapones() {
        $resultados = $this->controller->buscarHospedajes('ホテル');
        $this->assertNotEmpty($resultados);
        $this->assertGreaterThanOrEqual(1, count($resultados)); // Debe haber al menos 1 hotel
    }

    public function testBuscarHospedajesEnChino() {
        $resultados = $this->controller->buscarHospedajes('酒店');
        $this->assertNotEmpty($resultados);
        $this->assertGreaterThanOrEqual(1, count($resultados)); // Debe haber al menos 1 hotel
    }

    public function testBuscarHospedajesEnArabe() {
        $resultados = $this->controller->buscarHospedajes('فندق');
        $this->assertNotEmpty($resultados);
        $this->assertGreaterThanOrEqual(1, count($resultados)); // Debe haber al menos 1 hotel
    }

    // Otras pruebas
    public function testBuscarHospedajesConPrefijoInvalido() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('El prefijo debe tener al menos 3 caracteres.');
        $this->controller->buscarHospedajes('Ho');
    }

    public function testBuscarHospedajesSinResultados() {
        $resultados = $this->controller->buscarHospedajes('Inexistente');
        $this->assertEmpty($resultados); // No debe haber resultados
    }
}
?>