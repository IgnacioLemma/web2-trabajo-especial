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
    
        $fileType = $_FILES['foto_habitacion']['type'];
        if ($fileType == "image/jpg" || $fileType == "image/jpeg" || $fileType == "image/png") {
            // Nombre único para el archivo
            $filePath = "public/img/FotoHabitaciones/" . uniqid("", true) . "." . strtolower(pathinfo($_FILES['foto_habitacion']['name'], PATHINFO_EXTENSION));
            
            if (move_uploaded_file($_FILES['foto_habitacion']['tmp_name'], $filePath)) {
                $roomData = [
                    'nombre' => $_POST['nombre'],
                    'tipo' => $_POST['tipo'],
                    'capacidad' => $_POST['capacidad'],
                    'precio' => $_POST['precio'],
                    'foto_habitacion' => $filePath 
                ];
                if ($this->model->addRoom($roomData)) {
                    header('Location: ' . BASE_URL . 'Rooms');
                } else {
                        $this->errorView->showError("Error al agregar la habitación.");
                    }
            } else {
                $this->errorView->showError("Error al subir la imagen.");
            }
        } else {
            $this->errorView->showError("Solo se permiten imágenes JPG, JPEG, PNG");
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
    
        $roomData = [
            'id_habitacion' => $_POST['id_habitacion'],
            'Nombre' => $_POST['Nombre'],
            'Tipo' => $_POST['Tipo'],
            'Capacidad' => $_POST['Capacidad'],
            'Precio' => $_POST['Precio'],
        ];
    
        // Solo hacer update si la imagen está seteada
        if (isset($_FILES['foto_habitacion']) && $_FILES['foto_habitacion']['error'] === UPLOAD_ERR_OK) {
            $fileTemp = $_FILES['foto_habitacion']['tmp_name'];
            $filePath = "public/img/FotoHabitaciones/" . uniqid("", true) . "." . strtolower(pathinfo($_FILES['foto_habitacion']['name'], PATHINFO_EXTENSION));
            
            if (move_uploaded_file($fileTemp, $filePath)) {
                $roomData['foto_habitacion'] = $filePath; // Nueva imagen
            } else {
                return $this->errorView->showError("Error al subir la nueva imagen.");
            }
        } else {
            // Obtener imagen de la base de datos si no se subió una nueva
            $existingRoom = $this->model->getRoomById($roomData['id_habitacion']);
            $roomData['foto_habitacion'] = $existingRoom->foto_habitacion;
        }
        if ($this->model->updateRoom($roomData['id_habitacion'], $roomData)) {
            header('Location: ' . BASE_URL . 'Rooms');
        } else {
            $this->errorView->showError("Error al editar la habitación.");
        }
    }
}