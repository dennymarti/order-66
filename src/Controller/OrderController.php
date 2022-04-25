<?php

namespace App\Controller;

use App\Repository\LengthRepository;
use App\Repository\OrderRepository;
use App\Repository\OrderToppingRepository;
use App\Repository\ToppingRepository;
use App\Service\AuthenticationService;
use App\View\View;
use App\Repository\BreadRepository;

/**
 * Der Controller ist der Ort an dem es für jede Seite, welche der Benutzer
 * anfordern kann eine Methode gibt, welche die dazugehörende Businesslogik
 * beherbergt.
 *
 * Welche Controller und Funktionen muss ich erstellen?
 *   Es macht sinn, zusammengehörende Funktionen (z.B: User anzeigen, erstellen,
 *   bearbeiten & löschen) gemeinsam in einem passend benannten Controller (z.B:
 *   UserController) zu implementieren. Nicht zusammengehörende Features sollten
 *   jeweils auf unterschiedliche Controller aufgeteilt werden.
 *
 * Was passiert in einer Controllerfunktion?
 *   Die Anforderungen an die einzelnen Funktionen sind sehr unterschiedlich.
 *   Folgend die gängigsten:
 *     - Dafür sorgen, dass dem Benutzer eine View (HTML, CSS & JavaScript)
 *         gesendet wird.
 *     - Daten von einem Model (Verbindungsstück zur Datenbank) anfordern und
 *         der View übergeben, damit diese Daten dann für den Benutzer in HTML
 *         Code umgewandelt werden können.
 *     - Daten welche z.B. von einem Formular kommen validieren und dem Model
 *         übergeben, damit sie in der Datenbank persistiert werden können.
 */
class OrderController
{
    /**
     * Die index Funktion des DefaultControllers sollte in jedem Projekt
     * existieren, da diese ausgeführt wird, falls die URI des Requests leer
     * ist. (z.B. http://my-project.local/). Weshalb das so ist, ist und wann
     * welcher Controller und welche Methode aufgerufen wird, ist im Dispatcher
     * beschrieben.
     */
    public function index()
    {
        $view = new View('order/index');

        if (AuthenticationService::isAuthenticated()) {
            $view->isLoggedIn = true;
        }
        $view->title = 'Order';
        $view->heading = 'Order';

        $breadRepository = new BreadRepository();
        $view->breads = $breadRepository->readAll();

        $lengthRepository = new LengthRepository();
        $view->lengths = $lengthRepository->readAll();

        $toppingRepository = new ToppingRepository();
        $view->toppings = $toppingRepository->readAll();
        $view->display();
    }

    public function show() {
        AuthenticationService::requireLogin();

        $view = new View('order/show');
        $view->title = 'Orders';
        $view->heading = 'Orders';
        $view->isLoggedIn = true;

        $orderRepository = new OrderRepository();
        $view->orders = $orderRepository->readByUserIdResolveFKs($_SESSION['id']);
        $orderToppingRepository = new OrderToppingRepository();

        $toppingList = [];

        foreach($view->orders as $order) {
            $results = $orderToppingRepository->readByOrderIdResolveNames($order->id);

            $toppingList[$order->id] = [];

            foreach ($results as $result) {
                $toppingList[$order->id][] = $result->topping;
            }
        }

        $view->toppingList = $toppingList;

        $view->display();
    }

    public function create() {
        AuthenticationService::requireLogin();

        $breadId = $_POST['bread'];
        unset($_POST['bread']);
        $lengthId = $_POST['length'];
        unset($_POST['length']);
        $toppings = array_keys($_POST);
        $userId = $_SESSION['id'];

        $orderRepository = new OrderRepository();
        $orderId = $orderRepository->create($userId, $breadId, $lengthId);

        $orderToppingRepository = new OrderToppingRepository();
        $orderToppingRepository->createMany($orderId, $toppings);

        header('Location: /order/show');
    }

    public function edit() {
        AuthenticationService::requireLogin();

        $id = $_GET['id'];

        $view = new View('/order/edit');
        $view->title = 'Order '.$id;
        $view->heading = 'Order '.$id;
        $view->isLoggedIn = true;

        $orderRepository = new OrderRepository();
        $view->order = $orderRepository->readById($id);

        $breadRepository = new BreadRepository();
        $view->breads = $breadRepository->readAll();

        $lengthRepository = new LengthRepository();
        $view->lengths = $lengthRepository->readAll();

        $toppingRepository = new ToppingRepository();
        $view->toppings = $toppingRepository->readAll();

        $orderToppingRepository = new OrderToppingRepository();
        $view->toppingList = $orderToppingRepository->readByOrderIdResolveNames($view->order->id);

        $view->display();
    }

    public function delete() {
        AuthenticationService::requireLogin();

        $orderRepository = new OrderRepository();
        $orderRepository->deleteById($_GET['id']);

        header('Location: /order/show');
    }
}
