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
            echo "La habitación con el ID especificado no existe."; // Luego seria pagina de error
        }
    }

    public function showAddRoomForm() {
        $categorias = $this->model->showListCategory(); // Obtener las categorías para el select
        $this->view->showAddRoomForm($categorias);
    }

    public function addRoom() {
        // Verificar que todos los campos requeridos estén presentes y no vacíos
        if (!isset($_POST['nombre']) || empty(trim($_POST['nombre']))) {
            return $this->view->showError('Falta completar el nombre de la habitación');
        }
        if (!isset($_POST['Tipo']) || empty(trim($_POST['Tipo']))) {
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
            'Tipo' => $_POST['Tipo'],
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
    
        if ($this->model->removeRoom($roomId)) {
            header('Location: ' . BASE_URL . 'Rooms'); // Redirigir a la lista de habitaciones
        } else {
            $this->view->showError('Error al eliminar la habitación.');
        }
    }
    

// B
    public function showListCategory() {
        $categorias = $this->model->showListCategory(); // Obtiene la categorias de las habitaciones
        return $this->view->showListCategory($categorias);
    }
    public function showItemsCategory($tipo) {
        $habitaciones = $this->model->getHabitacionesPorTipo($tipo); // Obtiene las habitaciones por tipo
        return $this->view->showItemsCategory($habitaciones, $tipo);
        }
    }
