<?php

function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id_user'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id_user'];
            $res->user->email = $_SESSION['email_user'];
            return;
        } else {
            header('Location: ' . BASE_URL . 'showLogin');
            die();
        }
    }
