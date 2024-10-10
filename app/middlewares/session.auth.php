<?php

function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id_user'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id_user'];
            $res->user->email = $_SESSION['email'];
            return;
        }
    }
