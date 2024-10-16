<?php

require_once './app/models/hostel.model.php';
require_once './app/views/hostel.view.php';


class Hostelcontroller{
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new HostelModel();
        $this->view = new HostelView($res->user);
    }

    public function showHome() {
        $rooms = $this->model->getRooms(); 
        return $this->view->showHome($rooms);
    }

    public function errorPage() {
        $this->view->showErrorPage();
    }

// A
    public function showRoom() {
        $rooms = $this->model->getRooms(); // Obtiene todas las habitaciones
        return $this->view->showRooms($rooms); // Envía las habitaciones a la vista
    }
    public function showRoomDetails($id_habitacion) {
        $room = $this->model->getRoomById($id_habitacion);

        if ($room) {
            $this->view->showRoomDetails($room);
        } else {
            header('Location: ' . BASE_URL . 'errorPage');
        }
    }

    // AMB B
    public function showAddRoomForm() {
        $categorias = $this->model->showListCategory(); // Obtener las categorías para el select
        $this->view->showAddRoomForm($categorias);
    }

    public function addRoom() {
        // Verificar que todos los campos requeridos estén presentes y no vacíos
        if (!isset($_POST['nombre']) || empty(trim($_POST['nombre']))) {
            return $this->view->showError('Falta completar el nombre de la habitación');
        }
        if (!isset($_POST['tipo']) || empty(trim($_POST['tipo']))) {
            return $this->view->showError('Falta seleccionar el tipo de habitación');
        }
        if (!isset($_POST['capacidad']) || empty(trim($_POST['capacidad']))) {
            return $this->view->showError('Falta completar la capacidad');
        }
        if (!isset($_POST['precio']) || empty(trim($_POST['precio']))) {
            return $this->view->showError('Falta completar el precio');
        }
        if (!isset($_POST['foto_habitacion']) || empty(trim($_POST['foto_habitacion']))) {
            return $this->view->showError('Falta completar la URL de la foto');
        }

        $roomData = [
            'nombre' => $_POST['nombre'],
            'tipo' => $_POST['tipo'],
            'capacidad' => $_POST['capacidad'],
            'precio' => $_POST['precio'],
            'foto_habitacion' => $_POST['foto_habitacion']
        ];
    
        if ($this->model->addRoom($roomData)) {
            header('Location: ' . BASE_URL . 'Rooms');
        } else {
            $this->view->showError("Error al agregar la habitación.");
        }
    }
    
    public function deleteRoom() {
        if (!isset($_POST['id_habitacion']) || empty($_POST['id_habitacion'])) {
            return $this->view->showError('Falta el ID de la habitación.');
        }
    
        $roomId = $_POST['id_habitacion'];
    
        if ($this->model->deleteRoom($roomId)) {
            header('Location: ' . BASE_URL . 'Rooms'); // Redirigir a la lista de habitaciones
        } else {
            $this->view->showError('Error al eliminar la habitación.');
        }
    }
    
    public function showEditRoomForm($id_habitacion) {
        $room = $this->model->getRoomById($id_habitacion);
        $categorias = $this->model->showListCategory();
    
        if ($room) {
            $this->view->showEditRoomForm($room, $categorias);
        } else {
            header('Location: ' . BASE_URL . 'errorPage');
        }
    }
    
    public function updateRoom() {
        if (empty($_POST['id_habitacion'])) {
            return $this->view->showError('Falta el ID de la habitación.');
        }
    
        $requiredFields = ['Nombre', 'Tipo', 'Capacidad', 'Precio', 'foto_habitacion'];
        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field]))) {
                return $this->view->showError("Falta completar el campo: " . ucfirst($field));
            }
        }
    
        $roomData = [
            'id_habitacion' => $_POST['id_habitacion'],
            'Nombre' => $_POST['Nombre'],
            'Tipo' => $_POST['Tipo'],
            'Capacidad' => $_POST['Capacidad'],
            'Precio' => $_POST['Precio'],
            'foto_habitacion' => $_POST['foto_habitacion']
        ];
    
        if ($this->model->updateRoom($roomData['id_habitacion'], $roomData)) {
            header('Location: ' . BASE_URL . 'Rooms');
        } else {
            $this->view->showError("Error al editar la habitación.");
        }
    }
    
// B
    public function showListCategory() {
        $categorias = $this->model->showListCategory(); // Obtiene la categorias de las habitaciones
        return $this->view->showListCategory($categorias);
    }
    public function showItemsCategory($tipo) {
        $habitaciones = $this->model->getHabitacionesPorTipo($tipo); // Obtiene las habitaciones por tipo

        if($habitaciones){
            return $this->view->showItemsCategory($habitaciones, $tipo);
        }else{
                return $this->errorPage();
            }
        }

        // ABM A
    public function showReservations() {
        $reservations = $this->model->showReservation();
        $this->view->showReservations($reservations);
    }
    public function showAddReservationForm() {
        $rooms = $this->model->getRooms(); 
        $this->view->addReservations($rooms); 
    }
    
    public function addReservation(){
        // Verificar que todos los campos no esten vacios
        if (!isset($_POST['id_habitacion']) || empty(trim($_POST['id_habitacion']))) {
            return $this->view->showError('Falta seleccionar la habitación');
        }
        if (!isset($_POST['nombre_cliente']) || empty(trim($_POST['nombre_cliente']))) {
            return $this->view->showError('Falto completar el nombre');
        }
        if (!isset($_POST['Check_in']) || empty(trim($_POST['Check_in']))) {
            return $this->view->showError('Falto completar el Check_in');
        }
        if (!isset($_POST['Check_out']) || empty(trim($_POST['Check_out']))) {
            return $this->view->showError('Falto completar el Check_out');
        }

        $id_habitacion = $_POST['id_habitacion'];
        $nombre_cliente = $_POST['nombre_cliente'];
        $Check_in = $_POST['Check_in'];
        $Check_out = $_POST['Check_out'];

        if (strtotime($Check_out) < strtotime($Check_in)) {
            return $this->view->showError('La fecha de Check-out debe ser posterior o igual a la de Check-in');
        }
    
        $this->model->addReservation($id_habitacion, $nombre_cliente, $Check_in, $Check_out);
        header('Location: ' . BASE_URL . 'showReservations');
        exit();
    }
    public function deleteReservation() {
        if (!isset($_POST['id_reserva'])) {
            $this->view->showError('ID de reserva no especificado.');
            return;
        }
        $id_reserva = $_POST['id_reserva'];
        if ($this->model->deleteReservation($id_reserva)) {
            header('Location: ' . BASE_URL . 'showReservations');
        } else {
            $this->view->showError('Error al eliminar la reserva.');
        }
        exit();
    }
    public function editReservation($id_reserva) {
        //busca el id e la reserva y manda al form para cambiar los datos
        $reservation = $this->model->getReservationById($id_reserva);
        $rooms = $this->model->getRooms();
        if ($reservation) {
            $this->view->editReservationform($reservation, $rooms);
        } else {
            header('Location: ' . BASE_URL . 'errorPage');
        }
    }
    public function updateReservation() {
        if (empty($_POST['id_reserva'])) {
            return $this->view->showError('Falta el ID de la reserva.');
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
                return $this->view->showError("Error al editar reserva.");
            }
        } else {
            return $this->view->showError("Completar todos los campos");
        }
    }
}