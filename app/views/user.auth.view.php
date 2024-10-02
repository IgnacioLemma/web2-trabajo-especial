<?php

class User_auth_view{
    private $user = null;
    public function showLogin($error = ''){
        require_once 'templates/login.phtml';
    }
}
