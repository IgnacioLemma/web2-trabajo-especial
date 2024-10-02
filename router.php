<?php

require_once './libs/response.php';
require_once './app/middlewares/session.auth.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/hostel.controller.php';



// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); // utuliza las respuesta HTTP

$action = 'Rooms'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// inicio de la pagina -> HostelController-> showIndex();
// listar items  -> HostelController->showRoom();
// detalle items  -> HostelController->showRoomDetails();
// listar categorias -> HostelController->showListCategory();
// listar items x categoria -> HostelController -> showItemsCategory();


// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    // Por verse
    //case 'index':
    //     $controller = new HostelController();
    //     $controller->showIndex(); // Mostrar la página de inicio
    //    break;
    case 'Rooms':
        sessionAuthMiddleware($res); // Chequea que el usuario esta logeado y redirigue al login
        $controller = new HostelController($res);
        $controller->showRoom(); // Mostrar listado de habitaciones (item)
        break;
    case 'RoomsDetails':
        sessionAuthMiddleware($res);
        if (isset($params[1])) {
            $controller = new HostelController($res);
            $id_habitacion = $params[1]; 
            $controller->showRoomDetails($id_habitacion);// Mostrar detalle de la habitación (item)
        } 
        break;
    case 'ListCatergory':
        $controller = new HostelController();
        $controller->showListCategory(); // Mostrar listado de tipos (categoria)
        break;
    case 'ItemsCategory':
        if (isset($params[1])) { //Tomamos el tipo por url
            $controller = new HostelController();
            $tipo = $params[1];
            $controller->showItemsCategory($tipo); // Mostrar habitaciones por tipo
        } else {
            echo "Error: No se proporcionó el tipo de habitación.";
            }
        break;
        case 'showLogin':
            $controller = new Auth_controller();
            $controller->showLogin();
            break;
        case 'login':
            $controller = new Auth_controller();
            $controller->login();
            break;
    default:
        echo "404 Page Not Found"; // pagina de error por hacer
        break;
}