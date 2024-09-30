<?php

require_once 'app/controllers/hostel.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

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
        $controller = new HostelController();
        $controller->showRoom(); // Mostrar listado de habitaciones (item)
        break;
    case 'RoomsDetails':
        if (isset($params[1])) {
            $controller = new HostelController();
            $id_habitacion = $params[1]; 
            $controller->showRoomDetails($id_habitacion);// Mostrar detalle de la habitación (item)
        } else {
            echo "Error: No se proporcionó el ID de la habitación.";
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
    default:
        echo "404 Page Not Found"; // pagina de error por hacer
        break;
}