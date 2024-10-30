<?php

namespace Database\Seeders;

use App\Models\Database;

class DatabaseSeeder {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Inicializa la conexión a la base de datos
        $config = $this->db->getConfig();
        
        // Conectar a la base de datos específica
        $this->db->connectToDatabase($config['database']);
    }

    public function run() {
        $this->seedHoteles();
        $this->seedApartamentos();
    }

    private function seedHoteles() {
        $pdo = $this->db->getConnection(); // Obtener conexión a la base de datos

        // Iniciar transacción
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO hoteles (nombre, estrellas, tipo_habitacion, ciudad, provincia) VALUES (?, ?, ?, ?, ?)");

            $hoteles = [
                ['Hotel Sol', 3, 'habitación doble con vistas', 'Valencia', 'Valencia'],
                ['Hotel Luna', 4, 'habitación doble', 'Mojacar', 'Almeria'],
                ['Hotel Mar', 3, 'habitación sencilla', 'Sanlucar', 'Cádiz'],
                ['Sun Hotel', 5, 'suite', 'London', 'England'],
                ['Moon Hotel', 4, 'deluxe room', 'Paris', 'France'],
                ['Hôtel Mer', 3, 'chambre simple', 'Nice', 'Côte d\'Azur'],
                ['Hôtel Plage', 5, 'suite de luxe', 'Marseille', 'Provence'],
                ['サンホテル', 3, 'スイート', '東京', '東京'],
                ['ムーンホテル', 4, 'デラックスルーム', '京都', '京都'],
                ['阳光酒店', 4, '豪华套房', '上海', '上海'],
                ['月亮酒店', 3, '家庭房', '北京', '北京'],
                ['Sun Palace', 5, 'luxury suite', 'Los Angeles', 'California'],
                ['Lune Hôtel', 4, 'chambre de luxe', 'Cannes', 'Provence'],
                ['日光酒店', 4, '豪华客房', '北京', '北京'],
                ['月亮湾度假村', 5, '豪华别墅', '三亚', '海南'],
                ['Sunrise Hotel', 3, 'ocean view room', 'Sydney', 'New South Wales'],
                ['Lune Palace', 4, 'suite familiale', 'Nice', 'Côte d\'Azur'],
                ['ホテル太陽', 4, 'スイートルーム', '東京', '東京'],
                ['ムーンリゾート', 5, 'プライベートビーチビラ', '沖縄', '沖縄'],
                ['阳光度假村', 4, '海景别墅', '三亚', '海南'],
                ['月光酒店', 3, '山景客房', '成都', '四川'],
                ['Sunset Hotel', 4, 'executive suite', 'Miami', 'Florida'],
                ['Lune Chalet', 3, 'chambre rustique', 'Chamonix', 'Alpes'],
                ['Palais de la Lune', 5, 'suite royale', 'Marrakech', 'Maroc'],
                ['日の出ホテル', 5, 'オーシャンビュースイート', '沖縄', '沖縄'],
                ['月の宿', 3, '和室', '京都', '京都'],
                ['阳光酒店', 4, '海滨别墅', '三亚', '海南'],
                ['月亮山庄', 5, '套房别墅', '杭州', '浙江'],
                // Agregar más hoteles en diferentes idiomas
            ];

            foreach ($hoteles as $hotel) {
                $stmt->execute($hotel);
            }

            // Confirmar transacción
            $pdo->commit();
            echo "Datos insertados en la tabla 'hoteles' con éxito.\n";
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            $pdo->rollBack();
            echo "Ocurrió un error al insertar los datos en la tabla 'hoteles': " . $e->getMessage() . "\n";
        }
    }

    private function seedApartamentos() {
        $pdo = $this->db->getConnection(); // Obtener conexión a la base de datos

        // Iniciar transacción
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO apartamentos (nombre, apartamentos_disponibles, capacidad_adultos, ciudad, provincia) VALUES (?, ?, ?, ?, ?)");
            
           
            $apartamentos = [
                ['Apartamentos Sol y Mar', 10, 4, 'Valencia', 'Valencia'],
                ['Apartamentos Luna Azul', 50, 6, 'Málaga', 'Málaga'],
                ['Apartamentos Marítimos', 20, 5, 'Cádiz', 'Cádiz'],
                ['Sun & Sea Apartments', 15, 3, 'Miami', 'Florida'],
                ['Blue Moon Apartments', 25, 4, 'New York', 'New York'],
                ['Appartements Mer', 8, 2, 'Nice', 'Côte d\'Azur'],
                ['Appartements Plage', 12, 3, 'Cannes', 'Provence'],
                ['サン＆シーアパートメント', 12, 4, '東京', '東京'],
                ['ブルームーンアパートメント', 20, 5, '大阪', '大阪'],
                ['阳光海景公寓', 25, 6, '上海', '上海'],
                ['蓝月公寓', 15, 4, '北京', '北京'],
                ['Sunrise Apartments', 10, 3, 'Sydney', 'New South Wales'],
                ['Lune & Mer Appartements', 18, 5, 'Marseille', 'Provence'],
                ['日月公寓', 8, 3, '京都', '京都'],
                ['阳光别墅', 6, 2, '香港', '香港'],
                ['Apartamentos Sol', 10, 3, 'Barcelona', 'Barcelona'],
                ['Apartamentos Luna', 15, 4, 'Sevilla', 'Sevilla'],
                ['Apartamentos Mar', 12, 3, 'Alicante', 'Alicante'],
                ['Sunset Apartments', 20, 5, 'Los Angeles', 'California'],
                ['Moonlight Apartments', 18, 4, 'Sydney', 'New South Wales'],
                ['Mer Apartments', 10, 3, 'Cannes', 'Provence'],
                ['Plage Apartments', 25, 6, 'Nice', 'Côte d\'Azur'],
                ['サンアパートメント', 15, 4, '東京', '東京'],
                ['月光アパートメント', 30, 6, '京都', '京都'],
                ['阳光公寓', 18, 5, '上海', '上海'],
                ['蓝海公寓', 10, 3, '北京', '北京'],
                ['Sunset Flats', 12, 4, 'London', 'England'],
                ['Lune Suites', 6, 2, 'Paris', 'France'],
                ['Appartements de la Mer', 15, 4, 'Marseille', 'Provence'],
                ['Appartements de la Plage', 20, 5, 'Cannes', 'Provence'],
                // Agregar más apartamentos en diferentes idiomas
            ];






            foreach ($apartamentos as $apartamento) {
                $stmt->execute($apartamento);
            }

            // Confirmar transacción
            $pdo->commit();
            echo "Datos insertados en la tabla 'apartamentos' con éxito.\n";
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            $pdo->rollBack();
            echo "Ocurrió un error al insertar los datos en la tabla 'apartamentos': " . $e->getMessage() . "\n";
        }
    }
}

?>