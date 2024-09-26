<?php

class HostelModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=hostel_web2;charset=utf8', 'root', '');
    }

    // Obtener todas las habitaciones
    public function getRooms() {
        $query = $this->db->prepare('SELECT * FROM habitaciones');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

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