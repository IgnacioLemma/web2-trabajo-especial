<?php

class User_auth_view{
    private $user = null;
    public function showLogin($error = ''){
        require_once 'templates/pages/login.phtml';
    }
    public function showSignup($error = '') {
        require_once 'templates/pages/signup.phtml';
    }
}
