<?php

class RoomsView{
    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }

    public function showHome($rooms){
        require_once './templates/pages/home.phtml';
    }

        // Muestra la lista de habitaciones
        public function showRooms($rooms) {
            require_once './templates/pages/showRooms.phtml';
        }
        // Muestra los detalles de las habitaciones
        public function showRoomDetails($room) {
            require_once './templates/pages/RoomDetails.phtml';
        }
    
        // ABM B
        public function showAddRoomForm($categorias) {
            require_once './templates/pages/addRoom.phtml';
        }
    
        public function showEditRoomForm($room, $categorias){
            require_once './templates/pages/editRoom.phtml';
        }
    
    // B
        // Muestra la lista de categorías (tipos de habitaciones)
        public function showListCategory($categories) {
            require_once './templates/pages/List_category.phtml';
        }
        // Muestra las habitaciones por tipo (categoría)
        public function showItemsCategory($rooms, $tipo) {
            require_once './templates/pages/Items_category.phtml';
        }
    
}