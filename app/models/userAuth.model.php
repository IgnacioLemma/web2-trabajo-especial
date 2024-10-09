<?php

class UserAuth_model{
    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=hostel_web2;charset=utf8', 'root', '');
    }

    public function getUserFromEmail($email){
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email_usuario = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}