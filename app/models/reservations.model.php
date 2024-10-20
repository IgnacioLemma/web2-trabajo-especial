<?php

require_once './app/models/hostel.model.php';

class ReservationsModel extends HostelModel{
       //Buscar reserva
    function showReservation(){
        $query = $this->db->prepare("SELECT * FROM reservas");
        $query->execute();
        $reservation = $query->fetchAll(PDO::FETCH_OBJ);
        return $reservation;
    }
    function addReservation($id_habitacion, $id_usuario, $nombre_cliente, $Check_in, $Check_out) {
        $query = $this->db->prepare("INSERT INTO reservas (id_habitacion, id_usuario, Check_in, Check_out, nombre_cliente) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$id_habitacion, $id_usuario, $Check_in, $Check_out, $nombre_cliente]);
    }       
    function deleteReservation($id_reserva) {
        $query = $this->db->prepare("DELETE FROM reservas WHERE id_reserva = ?");
        return $query->execute([$id_reserva]);
    }
    //Buscar habitacion ID para la reserva
    function getReservationById($id_reserva) {
        $query = $this->db->prepare('SELECT * FROM reservas WHERE id_reserva = ?');
        $query->execute([$id_reserva]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    function UpdateReservation($id_reserva, $id_habitacion, $nombre_cliente, $check_in, $check_out) {
        $query = $this->db->prepare('UPDATE reservas SET id_habitacion = ?, nombre_cliente = ?, Check_in = ?, Check_out = ? WHERE id_reserva = ?');
        return $query->execute([$id_habitacion, $nombre_cliente, $check_in, $check_out, $id_reserva]);
    }
}