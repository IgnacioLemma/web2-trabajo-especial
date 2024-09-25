<?php

class HostelView {

    // Muestra la lista de habitaciones
    public function showRooms($rooms) {
        require_once './templates/header.phtml';
        echo "<h1>Listado de Habitaciones</h1>";
        echo "<ul>";
        foreach ($rooms as $room) {
            echo "<li>{$room->Nombre} - Precio : {$room->Precio} - Tipo: {$room->Tipo}";
            echo " <a href='" . BASE_URL . "RoomsDetails/" . $room->id_habitacion . "'>Ver Detalles</a></li>";
        }
        echo "</ul>";
        require_once './templates/footer.phtml';
    }
}