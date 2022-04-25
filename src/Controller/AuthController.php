<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\View\View;
use App\Service\AuthenticationService;

class AuthController
{
    public function index()
    {
        $loginResult = AuthenticationService::login(UserController::escapeString($_POST['username']), UserController::escapeString($_POST['password']));

        if ($loginResult[0]) {
            header('Location: /user');
        } else {
            $view = new View('auth/login');

            $view->title = 'Login';
            $view->heading = 'Login';
            $view->error = $loginResult[1];
            $view->display();
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