<?php 

require_once './app/models/rooms.model.php';
require_once './app/views/rooms.view.php';
require_once './app/models/hostel.model.php';
require_once './app/views/error.view.php';

class RoomsController{

    private $model;
    private $view;

    private $errorView;

    public function __construct($res) {
        $this->model = new RoomsModel();
        $this->view = new RoomsView($res->user);
        $this->errorView = new errorView($res->user);
    }
    public function showHome() {
        $rooms = $this->model->getRooms(); 
        return $this->view->showHome($rooms);
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
            header('Location: ' . BASE_URL . 'errorPage');
        }
    }

    public function showListCategory() {
        $categorias = $this->model->showListCategory(); // Obtiene la categorias de las habitaciones
        return $this->view->showListCategory($categorias);
    }
    public function showItemsCategory($tipo) {
        $habitaciones = $this->model->getHabitacionesPorTipo($tipo); // Obtiene las habitaciones por tipo

        if($habitaciones){
            return $this->view->showItemsCategory($habitaciones, $tipo);
        }else{
                return $this->errorView->showError('Falta especificar tipo');
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
            return $this->errorView->showError('Falta completar el nombre de la habitación');
        }
        if (!isset($_POST['tipo']) || empty(trim($_POST['tipo']))) {
            return $this->errorView->showError('Falta seleccionar el tipo de habitación');
        }
        if (!isset($_POST['capacidad']) || empty(trim($_POST['capacidad']))) {
            return $this->errorView->showError('Falta completar la capacidad');
        }
        if (!isset($_POST['precio']) || empty(trim($_POST['precio']))) {
            return $this->errorView->showError('Falta completar el precio');
        }
        if (!isset($_POST['foto_habitacion']) || empty(trim($_POST['foto_habitacion']))) {
            return $this->errorView->showError('Falta completar la URL de la foto');
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
            $this->errorView->showError("Error al agregar la habitación.");
        }
    }
    
    public function deleteRoom() {
        if (!isset($_POST['id_habitacion']) || empty($_POST['id_habitacion'])) {
            return $this->errorView->showError('Falta el ID de la habitación.');
        }
    
        $roomId = $_POST['id_habitacion'];
    
        if ($this->model->deleteRoom($roomId)) {
            header('Location: ' . BASE_URL . 'Rooms'); // Redirigir a la lista de habitaciones
        } else {
            $this->errorView->showError('Error al eliminar la habitación.');
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
            return $this->errorView->showError('Falta el ID de la habitación.');
        }
    
        $requiredFields = ['Nombre', 'Tipo', 'Capacidad', 'Precio', 'foto_habitacion'];
        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field]))) {
                return $this->errorView->showError("Falta completar el campo: " . ucfirst($field));
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
            $this->errorView->showError("Error al editar la habitación.");
        }
    }
}