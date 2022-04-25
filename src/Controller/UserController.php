<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Repository\UserRepository;
use App\Service\AuthenticationService;
use App\View\View;
use http\Client\Curl\User;

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{

    private $namesArray = array("4-LOM", "Secura", "Ackbar", "Thrawn", "Ahsoka", "Anakin", "Ventress", "Sing", "Organa", "Offee", "Shan", "Ben", "Bib", "Biggs", "Boba", "Bossk", "Brakiss", "C-3PO", "Bane", "Cade", "Ming", "Rex", "Jax", "Chewbacca", "Cody", "Dooku", "Krayt", "Maul", "Nihilus", "Vader", "Rendar", "Dengar", "Durge", "Palpatine", "Kun", "Marek", "Madine", "Dodonna", "Grievous", "Veers", "Pellaeon", "Moff", "Greedo", "Solo", "IG 88", "Jabba", "Jacen", "Jaina", "Jango", "Jarael", "Jerec", "C'Baoth", "Ki-Adi-Mundi", "Kanos", "Fisto", "Katarn", "Durron", "Lando", "Luke", "Luminara", "Lumiya", "Windu", "Mara", "Vao", "Daala", "Anor", "Kenobi", "Padmé", "Koon", "Vizsla", "Xizor", "Leia", "PROXY", "Jinn", "Vos", "R2-D2", "Kota", "Revan", "Shan", "Opress", "Sebulba", "Shaak", "Shmi", "Karrde", "Ulic", "Marr", "Watto", "Wedge", "Yoda", "Zam", "Zayne", "Zuckuss", );

    public function index()
    {
        if (AuthenticationService::isAuthenticated()) {
//             $userRepository = new UserRepository();

            $view = new View('user/index');

            $view->isLoggedIn = true;

            $view->title = 'Account';
            $view->heading = 'Account';
            $view->user = AuthenticationService::getAuthenticatedUser();
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

    private function validate() {
        $firstName = $_POST['firstname'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $textPattern = '^[a-zA-Z]{3,}$';
        $passwordPattern = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*+-/?])(?=.{8,})';

        if (preg_match($textPattern, $firstName) && preg_match($textPattern, $name)) {
            if (preg_match($passwordPattern, $password)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function create() {
        $userRepository = new UserRepository();

        if ($this->validate()) {
            // To prevent sql injections and cross-site scripting
            $firstName = htmlentities(self::escapeString($_POST['firstname']));
            $name = htmlentities(self::escapeString($_POST['name']));
            $password = htmlentities(self::escapeString($_POST['password']));

            do {
                $nameIndex = rand(0, 93);
                $number = rand(10, 99);
                $randName = $this->namesArray[$nameIndex];
                $username = str_replace(' ', '', strtolower("$randName" . "$number"));
            } while(!empty($userRepository->readByUsername($username)));

            $userRepository->create($firstName, $name, $username, $password);

            if (AuthenticationService::login($username, $password)) {
                header('Location: /user');
            } else {
                echo "UUPs something went wrong!";
            }
        }
        else  {
            echo "Dini Muetter isch fett und du söusch üs nid probierä zhäcke oder verarschä";
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
