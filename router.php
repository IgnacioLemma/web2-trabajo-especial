<?php

require_once 'app/controllers/hostel.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// listar items  -> HostelController->showRoom();
// detalle items  -> HostelController->showRoomDetails();
// listar categorias -> HostelController->showListCategory();
// listar items x categoria -> HostelController -> showItemsCategory();


// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'Rooms':
        $controller = new HostelController();
        $controller->showRoom(); // Mostrar listado de habitaciones (item)
        break;
    case 'RoomsDetails':
        $controller = new HostelController();
        $controller->showRoomDetails(); // Mostrar detalle de la habitación (item)
        break;
    case 'ListCatergory':
        $controller = new HostelController();
        $controller->showListCategory(); // Mostrar listado de tipos (categoria)
        break;
    case 'ItemsCatergory':
        $controller = new HostelController();
        $controller->showItemsCategory($params[1]);  // Mostrar habitaciones (item) por tipo (categoria)
        break;
    default:
        echo "404 Page Not Found"; // pagina de error por hacer
        break;
}