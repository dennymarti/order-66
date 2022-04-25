<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
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

            $view->title = 'Account';
            $view->heading = 'Account';
            $view->user = $userRepository->readById($_SESSION['id']);
            $view->display();
        } else {
            header('Location: /auth/login');
        }
    }

    public function signup() {
        $view = new View('user/signup');

        $view->title = 'Sign up';
        $view->heading = 'Sign up';
        $view->display();
    }

    public function create()
    {
        // prevent sql injections
        $firstName = $this->escapeString($_POST['firstname']);
        $name = $this->escapeString($_POST['name']);
        $username = strtolower("$firstName" . "$name");
        $password = $this->escapeString($_POST['password']);

        $userRepository = new UserRepository();
        $userRepository->create($firstName, $name, $username, $password);

        if (AuthenticationService::login($username, $password)) {
            header('Location: /user');
        } else {
            echo "UUPs something went wrong!";
        }
    }

    public static function escapeString($value) {
        return mysqli_real_escape_string(ConnectionHandler::getConnection(), $value);
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
