<?php

class ReservationsView{
    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }
    public function showReservations($reservations, $roomNames) {
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