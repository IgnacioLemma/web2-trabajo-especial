<?php

require_once './app/models/userAuth.model.php';
require_once './app/views/user.auth.view.php';

class Auth_controller {
    private $model;
    private $view;

    public function __construct(){
        $this->view = new User_auth_view();
        $this->model = new UserAuth_model();
    }
    public function showLogin(){
        return $this->view->showLogin();
    }

    public function login(){
        if(empty($_POST['email_usuario']) || !isset($_POST['email_usuario'])){
            return $this->view->showLogin('No ha completado el campo "email"');
        }
        if(empty($_POST['contraseña']) || !isset($_POST['contraseña'])){
            return $this->view->showLogin('No ha completado el campo "contraseña"');
        }

        $email = $_POST['email_usuario'];
        $password = $_POST['contraseña'];
        $userAuthDB = $this->model->getUserFromEmail($email);

        if($userAuthDB && password_verify($password, $userAuthDB->contraseña)){
            session_start();
            $_SESSION['id_user'] = $userAuthDB->id_usuario;
            $_SESSION['email_user'] = $userAuthDB->email_usuario;
            $_SESSION['last_activity'] = time();
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Hubo un error 🐱‍💻');
        }
    }

    public function logout (){
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
}
