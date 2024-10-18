<?php

require_once './app/models/hostel.model.php';
require_once './app/views/error.view.php';


class Hostelcontroller{
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new HostelModel();
        $this->view = new errorView($res->user);
    }
    public function errorPage() {
        $this->view->showErrorPage();
    }
}