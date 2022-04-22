<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\AuthenticationService;
use App\View\View;

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        if (AuthenticationService::isAuthenticated()) {
            $userRepository = new UserRepository();

            $view = new View('user/index');

            $view->isLoggedIn = isset($_SESSION['id']);

            $view->title = 'Konto';
            $view->heading = 'Konto';
            $view->user = $userRepository->readById($_SESSION['id']);
            $view->display();
        } else {
            header('Location: /auth/login');
        }
    }

    public function signup() {
        $view = new View('user/signup');

        $view->title = 'Signup';
        $view->heading = 'Signup';
        $view->display();
    }

    public function create()
    {
        if (empty($_POST['firstname'])) {
            header('Location: /user/signup');
        }
        else {
            $firstName = $_POST['firstname'];
            $name = $_POST['name'];
            $username = strtolower("$firstName" . "$name");
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $name, $username, $password);

            if (AuthenticationService::login($username, $password)) {
                header('Location: /user');
            } else {
                echo "UUPs something went wrong!";
            }
        }
    }

    public function delete()
    {
        AuthenticationService::restrictAuthenticated();

        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        AuthenticationService::logout();

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /');
    }
}
