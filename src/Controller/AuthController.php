<?php

namespace App\Controller;

use App\Service\AuthenticationService;
use App\View\View;

class AuthController
{
    // to authenticate user with username and password and create new session id
    public function index()
    {
        $loginResult = AuthenticationService::login(htmlentities(UserController::escapeString($_POST['username'])),
            htmlentities(UserController::escapeString($_POST['password'])));

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

    // to display the login form
    public function login()
    {
        $view = new View('auth/login');

        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    // to destroy user session id
    public function logout()
    {
        AuthenticationService::logout();

        header('Location: /auth/login');
    }
}