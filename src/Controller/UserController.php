<?php

namespace App\Controller;

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

            $view->title = 'Konto';
            $view->heading = 'Konto';
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

    public function create()
    {
        if (empty($_POST['firstname'])) {
            header('Location: /user/signup');
        }
        else {
            $userRepository = new UserRepository();
            $firstName = $_POST['firstname'];
            $name = $_POST['name'];
            do {
                $nameIndex = rand(0, 93);
                $number = rand(10, 99);
                $randName = $this->namesArray[$nameIndex];
                $username = str_replace(' ', '', strtolower("$randName" . "$number"));
            }while(!empty($userRepository->readByUsername($username)));
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
