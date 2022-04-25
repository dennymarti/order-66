<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use App\Service\AuthenticationService;
use App\View\View;

class UserController
{
    // array to mix names for username
    private $namesArray = array("4-LOM", "Secura", "Ackbar", "Thrawn", "Ahsoka", "Anakin", "Ventress", "Sing", "Organa", "Offee", "Shan", "Ben", "Bib", "Biggs", "Boba", "Bossk", "Brakiss", "C-3PO", "Bane", "Cade", "Ming", "Rex", "Jax", "Chewbacca", "Cody", "Dooku", "Krayt", "Maul", "Nihilus", "Vader", "Rendar", "Dengar", "Durge", "Palpatine", "Kun", "Marek", "Madine", "Dodonna", "Grievous", "Veers", "Pellaeon", "Moff", "Greedo", "Solo", "IG 88", "Jabba", "Jacen", "Jaina", "Jango", "Jarael", "Jerec", "C'Baoth", "Ki-Adi-Mundi", "Kanos", "Fisto", "Katarn", "Durron", "Lando", "Luke", "Luminara", "Lumiya", "Windu", "Mara", "Vao", "Daala", "Anor", "Kenobi", "Padmé", "Koon", "Vizsla", "Xizor", "Leia", "PROXY", "Jinn", "Vos", "R2-D2", "Kota", "Revan", "Shan", "Opress", "Sebulba", "Shaak", "Shmi", "Karrde", "Ulic", "Marr", "Watto", "Wedge", "Yoda", "Zam", "Zayne", "Zuckuss",);

    // to display user account information
    public function index()
    {
        AuthenticationService::requireLogin();

        $view = new View('/user/index');

        $view->isLoggedIn = true;
        $view->title = 'Account';
        $view->heading = 'Account';
        $view->user = AuthenticationService::getAuthenticatedUser();
        $view->display();
    }

    // to display sign up form
    public function signup()
    {
        $view = new View('/user/signup');

        $view->title = 'Sign up';
        $view->heading = 'Sign up';
        $view->display();
    }

    // to create user in database
    public function create()
    {
        $userRepository = new UserRepository();

        if ($this->validate()) {
            $firstName = htmlentities(self::escapeString($_POST['firstname']));
            $name = htmlentities(self::escapeString($_POST['name']));
            $password = htmlentities(self::escapeString($_POST['password']));

            do {
                $nameIndex = rand(0, 93);
                $number = rand(10, 99);
                $randName = $this->namesArray[$nameIndex];
                $username = str_replace(' ', '', strtolower("$randName" . "$number"));
            } while (!empty($userRepository->readByUsername($username)));

            $userRepository->create($firstName, $name, $username, $password);

            if (AuthenticationService::login($username, $password)) {
                header('Location: /user');
            } else {
                echo "UUPs something went wrong!";
            }
        } else {
            echo "UUPs something went wrong!";
        }
    }

    // to prevent sql injections and cross-site scripting and database insertion errors
    private function validate()
    {
        $firstName = $_POST['firstname'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $textPattern = "/^[a-zA-Z]{3,}$/";
        $passwordPattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%&*\-+\/]).{8,}$/";

        if (preg_match($textPattern, $firstName)
            && preg_match($textPattern, $name)) {
            if (preg_match($passwordPattern, $password)) {
                return true;
            }
            return false;
        }
        return false;
    }

    // to escape sql commands
    public static function escapeString($value)
    {
        return mysqli_real_escape_string(ConnectionHandler::getConnection(), $value);
    }

    // to delete user from database
    public function delete()
    {
        AuthenticationService::restrictAuthenticated();

        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        $orderRepository = new OrderRepository();
        $orderRepository->deleteByUserId($_GET['id']);

        AuthenticationService::logout();

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /');
    }
}