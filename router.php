<?php
require_once './config.php';
require_once './libs/response.php';
require_once './app/middlewares/session.auth.php';
require_once './app/middlewares/verify.auth.middleware.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/hostel.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); // Utiliza las respuestas HTTP

$action = 'Rooms'; // Acción por defecto si no se envía ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Parsear la acción para separar la acción real de los parámetros
$params = explode('/', $action);

switch ($params[0]) {
    //case 'Home': 
        //$controller = new HostelController($res); 
       // $controller->showHome(); 
       // break;
    case 'Rooms':
        sessionAuthMiddleware($res); // Chequea que el usuario esté logueado
        verifyAuthMiddleware($res);
        $controller = new HostelController($res);
        $controller->showRoom(); // Mostrar listado de habitaciones (items)
        break;
    case 'RoomsDetails':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            $controller = new HostelController($res);
            $id_habitacion = $params[1]; 
            $controller->showRoomDetails($id_habitacion); // Mostrar detalle de la habitación (item)
        } else {
            echo "Error: No se proporcionó el ID de la habitación.";
        }
        break;
    case 'ListCategory':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new HostelController($res);
        $controller->showListCategory(); // Mostrar listado de tipos (categoría)
        break;
    case 'ItemsCategory':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) { // Tomamos el tipo por URL
            $controller = new HostelController($res);
            $tipo = $params[1];
            $controller->showItemsCategory($tipo); // Mostrar habitaciones por tipo
        } else {
            echo "Error: No se proporcionó el tipo de habitación.";
        }
        break;
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
    case 'showAddRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new HostelController($res);
        $controller->showAddRoomForm(); 
        break;
    case 'addRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new HostelController($res);
        $controller->addRoom();
        break;
    case 'deleteRoom':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new HostelController($res);
        $controller->deleteRoom();
        break;
    case 'errorPage':
        $controller = new HostelController($res);
        $controller->errorPage(); // Muestra la página de error
        break;
    default:
        header('Location: ' . BASE_URL . 'errorPage'); // Redirige a la página de error
        break;
}
