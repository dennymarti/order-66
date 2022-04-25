<?php

namespace App\Controller;

use App\Service\AuthenticationService;
use App\View\View;

class DefaultController
{
    public function index()
    {
        $view = new View('default/index');

        if (AuthenticationService::isAuthenticated()) {
            $view->isLoggedIn = true;
        }

        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->display();
    }
}
