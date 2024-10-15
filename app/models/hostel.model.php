<?php

class HostelModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=hostel_web2;charset=utf8', 'root', '');
    }

// A
    // Obtener todas las habitaciones
    public function getRooms() {
        $query = $this->db->prepare('SELECT * FROM habitaciones');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener habitaciones por ID
    public function getRoomById($id_habitacion) {
        $query = $this->db->prepare('SELECT * FROM habitaciones WHERE id_habitacion = ?');
        $query->execute([$id_habitacion]);
        return $query->fetch(PDO::FETCH_OBJ); // Devolver un objeto con los datos de la habitación
    }

    // agregar un nuevo ítem lado N de la relación
    public function addRoom($roomData) {
        $query = $this->db->prepare("INSERT INTO habitaciones (Nombre, Tipo, Capacidad, Precio, foto_habitacion) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$roomData['nombre'], $roomData['Tipo'], $roomData['capacidad'], $roomData['precio'], $roomData['foto_habitacion']]);
    }
    
    public function deleteRoom($roomId) {
        $query = "DELETE FROM habitaciones WHERE id_habitacion = :id_habitacion";
        $query = $this->db->prepare($query);
        $query->bindParam(':id_habitacion', $roomId, PDO::PARAM_INT);
        return $query->execute();
    }

    public function updateRoom($id, $data) {
        $query = $this->db->prepare("UPDATE habitaciones SET Nombre = ?, Tipo = ?, Capacidad = ?, Precio = ?, foto_habitacion = ? WHERE id_habitacion = ?");
        return $query->execute([$data['Nombre'], $data['Tipo'], $data['Capacidad'], $data['Precio'], $data['foto_habitacion'], $id]);
    }
    

// ABM B

    //Obtenemos las categorias
    public function showListCategory() {
        $query = $this->db->prepare("SELECT DISTINCT Tipo FROM habitaciones"); //Obtenemos los tipos de habitaciones
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener habitaciones por tipo (categoría)
    public function getHabitacionesPorTipo($tipo) {
        $query = $this->db->prepare("SELECT * FROM habitaciones WHERE Tipo = ?");
        $query->execute([$tipo]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //Buscar reserva
    public function showReservation(){
        $query = $this->db->prepare("SELECT * FROM reservas");
        $query->execute();
        $reservation = $query->fetchAll(PDO::FETCH_OBJ);
        return $reservation;
    }
    public function addReservation($id_habitacion, $nombre_cliente, $Check_in, $Check_out) {
        $query = $this->db->prepare("INSERT INTO reservas (id_habitacion, Check_in, Check_out, nombre_cliente) VALUES (?, ?, ?, ?)");
        $query->execute([$id_habitacion, $Check_in, $Check_out, $nombre_cliente]);
    }
    public function deleteReservation($id_reserva) {
        $query = $this->db->prepare("DELETE FROM reservas WHERE id_reserva = ?");
        return $query->execute([$id_reserva]);
    }
    //Buscar habitacion ID para la reserva
    public function getReservationById($id_reserva) {
        $query = $this->db->prepare("SELECT * FROM reservas WHERE id_reserva = ?");
        $query->execute([$id_reserva]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function UpdateReservation($id_reserva, $id_habitacion, $nombre_cliente, $check_in, $check_out) {
        $query = $this->db->prepare("UPDATE reservas SET id_habitacion = ?, nombre_cliente = ?, Check_in = ?, Check_out = ? WHERE id_reserva = ?");
        return $query->execute([$id_habitacion, $nombre_cliente, $check_in, $check_out, $id_reserva]);
    }
}