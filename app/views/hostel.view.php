<?php
class HostelView {

    // Muestra la lista de habitaciones
    public function showRooms($rooms) {
        require_once './templates/header.phtml';
        echo "<h1>Listado de Habitaciones</h1>";
        echo "<ul>";
        foreach ($rooms as $room) {
            echo "<li>{$room->Nombre} - Precio: {$room->Precio} - Tipo: {$room->Tipo}";
            echo " <a href='" . BASE_URL . "RoomsDetails/" . $room->id_habitacion . "'>Ver Detalles</a></li>";
        }
        echo "</ul>";
        require_once './templates/footer.phtml';
    }

    // Muestra la lista de categorías (tipos de habitaciones)
    public function showListCategory($categories) {
        require_once './templates/header.phtml';
        echo "<h1>Listado de Categorías de Habitaciones</h1>";
        echo "<ul>";
        foreach ($categories as $category) {
            echo "<li><a href='" . BASE_URL . "ItemsCategory/" . $category['Tipo'] . "'>{$category['Tipo']}</a></li>";
        }
        echo "</ul>";
        require_once './templates/footer.phtml';
    }

    // Muestra las habitaciones por tipo (categoría)
    public function showItemsCategory($rooms, $tipo) {
        require_once './templates/header.phtml';
        echo "<h1>Habitaciones del Tipo: {$tipo}</h1>";
        echo "<ul>";
        foreach ($rooms as $room) {
            echo "<li>{$room->Nombre} - Precio: {$room->Precio}";
            echo " <a href='" . BASE_URL . "RoomsDetails/" . $room->id_habitacion . "'>Ver Detalles</a></li>";
        }
        echo "</ul>";
        require_once './templates/footer.phtml';
    }
}

