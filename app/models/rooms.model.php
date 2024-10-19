<?php

require_once './app/models/hostel.model.php';

    class RoomsModel extends HostelModel{

// Obtener todas las habitaciones
    function getRooms() {
        $query = $this->db->prepare('SELECT * FROM habitaciones');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener habitaciones por ID
    function getRoomById($id_habitacion) {
        $query = $this->db->prepare('SELECT * FROM habitaciones WHERE id_habitacion = ?');
        $query->execute([$id_habitacion]);
        return $query->fetch(PDO::FETCH_OBJ); // Devolver un objeto con los datos de la habitación
    }

    // ABM B
    function addRoom($roomData) {
        $query = $this->db->prepare("INSERT INTO habitaciones (Nombre, Tipo, Capacidad, Precio, foto_habitacion) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$roomData['nombre'], $roomData['tipo'], $roomData['capacidad'], $roomData['precio'], $roomData['foto_habitacion']]);
    }
    
    function deleteRoom($roomId) {
        $query = "DELETE FROM habitaciones WHERE id_habitacion = :id_habitacion";
        $query = $this->db->prepare($query);
        $query->bindParam(':id_habitacion', $roomId, PDO::PARAM_INT);
        return $query->execute();
    }

    function updateRoom($id, $data) {
        $query = $this->db->prepare("UPDATE habitaciones SET Nombre = ?, Tipo = ?, Capacidad = ?, Precio = ?, foto_habitacion = ? WHERE id_habitacion = ?");
        return $query->execute([$data['Nombre'], $data['Tipo'], $data['Capacidad'], $data['Precio'], $data['foto_habitacion'], $id]);
    }
    
    //Obtenemos las categorias
    function showListCategory() {
        $query = $this->db->prepare("SELECT DISTINCT Tipo FROM habitaciones"); //Obtenemos los tipos de habitaciones
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener habitaciones por tipo (categoría)
    function getHabitacionesPorTipo($tipo) {
        $query = $this->db->prepare("SELECT * FROM habitaciones WHERE Tipo = ?");
        $query->execute([$tipo]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}