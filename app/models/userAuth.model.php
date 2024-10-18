<?php

require_once './app/models/hostel.model.php';
class UserAuth_model extends HostelModel{

    // Método para obtener un usuario a partir del email
    public function getUserFromEmail($email) {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->bindParam(':email', $email); // Utiliza parámetros nombrados para mayor seguridad
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ); // Retorna el usuario como un objeto
    }

    public function createUser($email, $password) {
        // Verificar si el email ya existe
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute([$email]);
        if ($query->fetch(PDO::FETCH_OBJ)) {
            return false; // El email ya está en uso
        }

        // Insertar nuevo usuario
        $query = $this->db->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
        return $query->execute([$email, $password]);
    }

    // Método para registrar un nuevo usuario (opcional)
    public function registerUser($email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashea la contraseña
        $query = $this->db->prepare("INSERT INTO usuarios (email, password) VALUES (:email, :password)");
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashed_password);
        return $query->execute(); // Retorna true si se insertó correctamente
    }
}
