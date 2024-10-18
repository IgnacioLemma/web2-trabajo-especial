<?php
class errorView {

    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }
    public function showError($error) {
        require_once 'templates/errors/error.phtml';
    }
    public function showErrorPage() {
        require_once './templates/errors/errorPage.phtml'; // Asegúrate de que la ruta sea correcta
    }

}

