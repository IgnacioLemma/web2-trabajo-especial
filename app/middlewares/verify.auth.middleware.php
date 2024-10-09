<?php
    function verifyAuthMiddleware($res) {
        if($res->user) {
            return;
        } else {
            header('Location: ' . BASE_URL . 'showLogin');
            die();
        }
    }

