<?php

namespace Views;

use App\Models\Hotel;
use App\Models\Apartamento;

interface HospedajeViewInterface {
    public function render(array $hoteles, array $apartamentos): string;
}

?>