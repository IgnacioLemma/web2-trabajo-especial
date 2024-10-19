<?php
require_once './config/config.php';
require_once './libs/response.php';
require_once './app/middlewares/session.auth.php';
require_once './app/middlewares/verify.auth.middleware.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/error.controller.php';
require_once './app/controllers/reservations.controller.php';
require_once './app/controllers/rooms.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); // Utiliza las respuestas HTTP

$action = 'Home'; // Acción por defecto si no se envía ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Parsear la acción para separar la acción real de los parámetros
$params = explode('/', $action);

switch ($params[0]) {
    case 'Home': 
        sessionAuthMiddleware($res);
        $controller = new RoomsController($res); 
        $controller->showHome(); 
        break;
    case 'Rooms':
        sessionAuthMiddleware($res);
        $controller = new RoomsController($res);
        $controller->showRoom(); // Mostrar listado de habitaciones (items)
        break;
    case 'RoomsDetails':
        sessionAuthMiddleware($res);
        if (isset($params[1])) { // Si es false entra a la pagina de error
            $controller = new RoomsController($res);
            $id_habitacion = $params[1]; 
            $controller->showRoomDetails($id_habitacion); // Mostrar detalle de la habitación (item)
        }
        break;
    case 'ListCategory':
        sessionAuthMiddleware($res);
        $controller = new RoomsController($res);
        $controller->showListCategory(); // Mostrar listado de tipos (categoría)
        break;
    case 'ItemsCategory':
        sessionAuthMiddleware($res);
        if (isset($params[1])) { // Tomamos el tipo por URL
            $controller = new RoomsController($res);
            $tipo = $params[1];
            $controller->showItemsCategory($tipo); // Mostrar habitaciones por tipo
        } else {
            echo "Error: No se proporcionó el tipo de habitación."; // <-- nunca entra
        }
        break;
    // Login y Logout
    case 'showSignup':
        $controller = new Auth_controller();
        $controller->showSignup(); // Mostrar la vista de registro
        break;
    case 'signup':
        $controller = new Auth_controller();
        $controller->signup(); // Manejar el registro de usuario
        break;
    case 'showLogin':
        $controller = new Auth_controller();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new Auth_controller();
        $controller->login();
        break;
    case 'logout':
        $controller = new Auth_controller();
        $controller->logout();
    break;
    // ABM B
    case 'showAddRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RoomsController($res);
        $controller->showAddRoomForm(); 
        break;
    case 'addRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RoomsController($res);
        $controller->addRoom();
        break;
    case 'deleteRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RoomsController($res);
        $controller->deleteRoom();
        break;
    case 'editRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RoomsController($res);
        if (isset($_GET['id_habitacion'])) {
            $id_habitacion = $_GET['id_habitacion']; // Obtén el id de la habitación
            $controller->showEditRoomForm($id_habitacion);
        } else {
            header('Location: ' . BASE_URL . 'errorPage');
        }
        break;
    case 'updateRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RoomsController($res);
        $controller->updateRoom(); 
        break; 
    //ABM A
    case "showReservations":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ReservationsController($res);
        $controller->showReservations(); // Muestra la lista de reservas
        break;
    case "showAddReservation":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ReservationsController($res);
        $controller->showAddReservationForm(); // Muestra el formulario de reserva
        break;
    case "addReservation":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ReservationsController($res);
        $controller -> addReservation();
        break;
    case "deleteReservation":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ReservationsController($res);
        $controller->deleteReservation();
        break;
    case "editReservation":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ReservationsController($res);
        if (isset($_POST['id_reserva'])) {
            $id_reserva = $_POST['id_reserva']; // Obtén el id de la reserva
            $controller->editReservation($id_reserva);
        } else {
            header('Location: ' . BASE_URL . 'errorPage');
        }
        break;
    case "updateReservation":
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ReservationsController($res);
        $controller->updateReservation(); 
        break;
    //error page
    case 'errorPage':
        sessionAuthMiddleware($res);
        $controller = new errorController($res);
        $controller->errorPage(); // Muestra la página de error
        break;
    default:
        header('Location: ' . BASE_URL . 'errorPage'); // Redirige a la página de error
        break;
}
