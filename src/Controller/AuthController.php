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
            $userController = new UserController();
            $userController->index();
        }
        else {
            echo "UUPs something went wrong!";
        }


    }

    public function login() {
        $view = new View('auth/login');

        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function signup() {
        $view = new View('auth/signup');

        $view->title = 'Signup';
        $view->heading = 'Signup';
        $view->display();
    }

    public function logout(){
        AuthenticationService::logout();

        $defaultController = new DefaultController();
        $defaultController->index();
    }
}