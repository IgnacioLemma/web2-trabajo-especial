<?php

require_once './app/models/hostel.model.php';
require_once './app/views/error.view.php';


class errorController{
    private $view;

    public function __construct($res) {
        $this->view = new errorView($res->user);
    }
    public function errorPage() {
        $this->view->showErrorPage();
    }
}