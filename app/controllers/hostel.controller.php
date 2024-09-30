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
    public function showRoomDetails($id_habitacion) {
        $room = $this->model->getRoomById($id_habitacion);

        if ($room) {
            $this->view->showRoomDetails($room);
        } else {
            echo "La habitación con el ID especificado no existe."; // Luego seria pagina de error
        }
    }
    public function showListCategory() {
        $categorias = $this->model->showListCategory(); // Obtiene la categorias de las habitaciones
        return $this->view->showListCategory($categorias);
    }
    public function showItemsCategory($tipo) {
        $habitaciones = $this->model->getHabitacionesPorTipo($tipo); // Obtiene las habitaciones por tipo
        return $this->view->showItemsCategory($habitaciones, $tipo);
        }
    }
