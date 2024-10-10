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
    

// B

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
}