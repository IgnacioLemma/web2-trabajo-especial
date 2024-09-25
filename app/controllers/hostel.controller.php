<?php

require_once './app/models/hostel.model.php';
require_once './app/views/hostel.view.php';

class Hostelcontroller{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new HostelModel(); 
        $this->view = new HostelView();
    }
    public function showRoom() {
        $rooms = $this->model->getRooms(); // Obtiene todas las habitaciones
        return $this->view->showRooms($rooms); // Envía las habitaciones a la vista
    }
}