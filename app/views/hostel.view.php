<?php
class HostelView {

    // Muestra la lista de habitaciones
    public function showRooms($rooms) {
        require_once './templates/header.phtml';
        echo "<div class='container'>";
        echo "<h1 class='text-center mt-4'>Listado de Habitaciones</h1>";
        echo "<div class='row'>";
        foreach ($rooms as $room) {
            echo "<div class='col-md-4 mb-4'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$room->Nombre}</h5>";
            echo "<a href='" . BASE_URL . "RoomsDetails/" . $room->id_habitacion . "' class='btn btn-primary'>Ver Detalles</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
        require_once './templates/footer.phtml';
    }
    
    // Muestra los detalles de las habitaciones
    public function showRoomDetails($room) {
        require_once './templates/header.phtml';
        require_once './templates/room_details.phtml';
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

