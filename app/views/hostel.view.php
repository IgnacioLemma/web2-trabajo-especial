<?php
class HostelView {

    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }

    public function showHome($rooms){
        require_once './templates/pages/home.phtml';
    }
    public function showError($error) {
        require_once 'templates/errors/error.phtml';
    }
    public function showErrorPage() {
        require_once './templates/errors/errorPage.phtml'; // Asegúrate de que la ruta sea correcta
    }

// A
    // Muestra la lista de habitaciones
    public function showRooms($rooms) {
        require_once './templates/pages/showRooms.phtml';
    }
    // Muestra los detalles de las habitaciones
    public function showRoomDetails($room) {
        require_once './templates/pages/RoomDetails.phtml';
    }

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
    //Mostrar reservas
    public function showReservations($reservations) {
        require_once './templates/pages/showReservations.phtml';
    }
    //Mostrar fromualrio para hacer una reserva
    public function addReservations($rooms){
        require_once './templates/pages/addReservations.phtml';
    }
    public function editReservationform($reservation, $rooms) { 
        require_once './templates/pages/editReservation.phtml';
    }
}

