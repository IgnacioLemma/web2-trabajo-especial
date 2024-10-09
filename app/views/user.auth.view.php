<?php

class User_auth_view{
    private $user = null;
    public function showLogin($error = ''){
        require_once 'templates/login.phtml';
    }
    public function showSignup($error = '') {
        require 'templates/form_signup.phtml';
    }

}
