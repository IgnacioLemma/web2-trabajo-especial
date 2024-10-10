<?php
class HostelView {

    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }

// A
    // Muestra la lista de habitaciones
    public function showRooms($rooms) {
        require_once './templates/showRooms.phtml';
    }
    // Muestra los detalles de las habitaciones
    public function showRoomDetails($room) {
        require_once './templates/RoomDetails.phtml';
    }

    public function showAddRoomForm($categorias) {
        require_once './templates/addRoom.phtml';
    }

// B
    // Muestra la lista de categorías (tipos de habitaciones)
    public function showListCategory($categories) {
        require_once './templates/List_category.phtml';
    }
    // Muestra las habitaciones por tipo (categoría)
    public function showItemsCategory($rooms, $tipo) {
        require_once './templates/Items_category.phtml';
    }

    public function showError($error) {
        require_once 'templates/error.phtml';
    }

}

