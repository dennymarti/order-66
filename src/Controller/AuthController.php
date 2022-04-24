<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\View\View;
use App\Service\AuthenticationService;

class AuthController
{
    public function index()
    {
        if (AuthenticationService::login($_POST['username'], $_POST['password'])){
            header('Location: /user');
        } else {
            echo "UUPs something went wrong!";
        }
    }

    public function login() {
        $view = new View('auth/login');

        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function logout(){
        AuthenticationService::logout();

        header('Location: /auth/login');
    }
}