<?php

require_once './app/models/userAuth.model.php';
require_once './app/views/user.auth.view.php';

class Auth_controller {
    private $model;
    private $view;

    public function __construct() {
        $this->view = new User_auth_view();
        $this->model = new UserAuth_model();
    }

    public function showLogin() {
        return $this->view->showLogin(); // Muestra la vista de login
    }

    public function login() {
        // Verifica si los campos están vacíos
        if (empty($_POST['email'])) {
            return $this->view->showLogin('No ha completado el campo "email"');
        }
        if (empty($_POST['password'])) {
            return $this->view->showLogin('No ha completado el campo "contraseña"');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Obtiene el usuario de la base de datos por email
        $userAuthDB = $this->model->getUserFromEmail($email);

        // Verifica si el usuario existe y la contraseña es correcta
        if ($userAuthDB && password_verify($password, $userAuthDB->password)) {
            session_start(); // Inicia la sesión
            // Almacena información en la sesión
            $_SESSION['id_user'] = $userAuthDB->id_usuario;
            $_SESSION['email'] = $userAuthDB->email;
            $_SESSION['last_activity'] = time(); // Marca la última actividad
            header('Location: ' . BASE_URL); // Redirige a la página principal
            exit; // Asegura que no se ejecute más código
        } else {
            return $this->view->showLogin('Hubo un error 🐱‍💻');
        }
    }

    public function showSignup($error = '') {
        $this->view->showSignup($error); // Mostrar la vista de registro
    }

    public function signup() {
        if(empty($_POST['email']) || !isset($_POST['email'])) {
            return $this->view->showSignup('No ha completado el campo "email"');
        }

        if(empty($_POST['password']) || !isset($_POST['password'])) {
            return $this->view->showSignup('No ha completado el campo "contraseña"');
        }

        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

        // Guardar el nuevo usuario en la base de datos
        $userCreated = $this->model->createUser($email, $password);
        
        if ($userCreated) {
            header('Location: ' . BASE_URL . 'showLogin'); // Redirigir al login después de registrarse
        } else {
            return $this->view->showSignup('Email ya regristrado 🐱‍👤');
        }
    }
    public function logout() {
        session_start(); // Inicia la sesión para poder destruirla
        session_destroy(); // Destruye la sesión
        header('Location: ' . BASE_URL); // Va al home
        exit;
    }
}
