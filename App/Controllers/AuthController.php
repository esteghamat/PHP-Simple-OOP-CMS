<?php

namespace App\Controllers;
use App\Core\Request;
use App\Services\View\View;

class AuthController
{
    public function __construct()
    {
        echo "I am in Auth Controller.<br>";
    }

    public function login(Request $request)
    {
        $userModel = new User();

        $data = array(
            'total_users' => $userModel->read()
        );

        View::load('auth.login-form', $data);
    }

    public function register()
    {
        //echo "I am in Register method.<br>";
        View::load('auth.register');
    }   

}
