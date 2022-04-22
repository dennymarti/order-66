<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\View\View;
use App\Service\AuthenticationService;

class AuthController
{
    public function index()
    {
        AuthenticationService::login($_POST['username'], $_POST['password']);

        $defaultController = new DefaultController();
        $defaultController->index();
    }

    public function logout(){
        AuthenticationService::logout();

        $defaultController = new DefaultController();
        $defaultController->index();
    }
}