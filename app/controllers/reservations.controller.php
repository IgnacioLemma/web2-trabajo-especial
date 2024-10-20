<?php

require_once './app/models/reservations.model.php';
require_once './app/controllers/rooms.controller.php';
require_once './app/views/reservations.view.php';
require_once './app/views/error.view.php';

class ReservationsController{

    private $model;
    private $view;

    private $errorView;

    private $roomsModel;
    public function __construct($res) {
        $this->model = new ReservationsModel();
        $this->view = new ReservationsView($res->user);
        $this->errorView = new errorView($res->user);
        $this->roomsModel = new RoomsModel();
    }



// ABM A
    public function showReservations() {
        $reservations = $this->model->showReservation();
        
        $rooms = $this->roomsModel->getRooms();
        $roomNames = [];
        foreach ($rooms as $room) {
            $roomNames[$room->id_habitacion] = $room->Nombre;
        }
        $this->view->showReservations($reservations, $roomNames);
    }
        
    public function showAddReservationForm() {
        $rooms = $this->roomsModel->getRooms(); 
        $this->view->addReservations($rooms); 
    }
    
    public function addReservation(){
        // Verificar que todos los campos no esten vacios
        if (!isset($_POST['id_habitacion']) || empty(trim($_POST['id_habitacion']))) {
            return $this->errorView->showError('Falta seleccionar la habitación');
        }
        if (!isset($_POST['nombre_cliente']) || empty(trim($_POST['nombre_cliente']))) {
            return $this->errorView->showError('Falto completar el nombre');
        }
        if (!isset($_POST['Check_in']) || empty(trim($_POST['Check_in']))) {
            return $this->errorView->showError('Falto completar el Check_in');
        }
        if (!isset($_POST['Check_out']) || empty(trim($_POST['Check_out']))) {
            return $this->errorView->showError('Falto completar el Check_out');
        }

        $id_habitacion = $_POST['id_habitacion'];
        $nombre_cliente = $_POST['nombre_cliente'];
        $Check_in = $_POST['Check_in'];
        $Check_out = $_POST['Check_out'];

        if (strtotime($Check_out) < strtotime($Check_in)) {
            return $this->errorView->showError('La fecha de Check-out debe ser posterior o igual a la de Check-in');
        }
    
        $id_usuario = $_SESSION['id_user'] ?? null;
        if (!$id_usuario) {
            return $this->errorView->showError('El usuario no está logueado.');
        }

        $this->model->addReservation($id_habitacion, $id_usuario, $nombre_cliente, $Check_in, $Check_out);
        header('Location: ' . BASE_URL . 'showReservations');
        exit();
    }
    public function deleteReservation() {
        if (!isset($_POST['id_reserva'])) {
            $this->errorView->showError('ID de reserva no especificado.');
            return;
        }
        $id_reserva = $_POST['id_reserva'];
        if ($this->model->deleteReservation($id_reserva)) {
            header('Location: ' . BASE_URL . 'showReservations');
        } else {
            $this->errorView->showError('Error al eliminar la reserva.');
        }
        exit();
    }
    public function editReservation($id_reserva) {
        //busca el id e la reserva y manda al form para cambiar los datos
        $reservation = $this->model->getReservationById($id_reserva);
        $rooms = $this->roomsModel->getRooms();
        if ($reservation) {
            $this->view->editReservationform($reservation, $rooms);
        } else {
            header('Location: ' . BASE_URL . 'errorPage');
        }
    }
    public function updateReservation() {
        if (empty($_POST['id_reserva'])) {
            return $this->errorView->showError('Falta el ID de la reserva.');
        }
        //toma todos los datos de la reserva
        $id_reserva = $_POST['id_reserva'];
        $id_habitacion = $_POST['id_habitacion'] ?? null;
        $nombre_cliente = $_POST['nombre_cliente'] ?? null;
        $check_in = $_POST['Check_in'] ?? null;
        $check_out = $_POST['Check_out'] ?? null;
    
        if ($id_habitacion && $nombre_cliente && $check_in && $check_out) {
            if ($this->model->UpdateReservation($id_reserva, $id_habitacion, $nombre_cliente, $check_in, $check_out)) {
                header('Location: ' . BASE_URL . 'showReservations');
            } else {
                return $this->errorView->showError("Error al editar reserva.");
            }
        } else {
            return $this->errorView->showError("Completar todos los campos");
        }
    }
}