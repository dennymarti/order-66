<?php

namespace App\Controller;

use App\Repository\BreadRepository;
use App\Repository\CategorieRepository;
use App\Repository\LengthRepository;
use App\Repository\OrderRepository;
use App\Repository\OrderToppingRepository;
use App\Repository\ToppingRepository;
use App\Service\AuthenticationService;
use App\View\View;

class OrderController
{
    public function index()
    {
        AuthenticationService::requireLogin();

        $view = new View('order/index');

        $view->title = 'Order';
        $view->heading = 'Order';
        $view->isLoggedIn = true;

        $breadRepository = new BreadRepository();
        $view->breads = $breadRepository->readAll();

        $lengthRepository = new LengthRepository();
        $view->lengths = $lengthRepository->readAll();

        $categorieRepository = new CategorieRepository();
        $categories = $categorieRepository->readAll();

        $toppingRepository = new ToppingRepository();
        foreach ($categories as $cat) {
            $toppingsByCat[$cat->name] = [];
            foreach ($toppingRepository->readAllByCategorie($cat->id) as $row) {
                $toppingsByCat[$cat->name][] = $row;
            }

        }
        $view->toppingsByCat = $toppingsByCat;

        $view->display();
    }

    public function show()
    {
        AuthenticationService::requireLogin();

        $view = new View('order/show');
        $view->title = 'Orders';
        $view->heading = 'Orders';
        $view->isLoggedIn = true;

        $orderRepository = new OrderRepository();
        $view->orders = $orderRepository->readByUserIdResolveFKs($_SESSION['id']);
        $orderToppingRepository = new OrderToppingRepository();

        $toppingList = [];

        foreach ($view->orders as $order) {
            $results = $orderToppingRepository->readByOrderIdResolveNames($order->id);

            $toppingList[$order->id] = [];

            foreach ($results as $result) {
                $toppingList[$order->id][] = $result->topping;
            }
        }

        $view->toppingList = $toppingList;

        $view->display();
    }

    public function create()
    {
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

    public function edit()
    {
        AuthenticationService::requireLogin();

        $id = $_GET['id'];

        $view = new View('/order/edit');
        $view->title = 'Order ' . $id;
        $view->heading = 'Order ' . $id;
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

    public function delete()
    {
        AuthenticationService::requireLogin();

        $orderRepository = new OrderRepository();
        $orderRepository->deleteById(htmlentities(UserController::escapeString($_GET['id'])));

        header('Location: /order/show');
    }

    public function update()
    {
        AuthenticationService::requireLogin();

        $orderId = htmlentities(UserController::escapeString($_GET['id']));
        var_dump($orderId);
        $breadId = $_POST['bread'];
        unset($_POST['bread']);
        $lengthId = $_POST['length'];
        unset($_POST['length']);
        $toppings = array_keys($_POST);
        $userId = $_SESSION['id'];

        $orderToppingRepository = new OrderToppingRepository();
        $orderToppingRepository->deleteByOrderId($orderId);

        $orderRepository = new OrderRepository();
        $orderRepository->update($orderId, $breadId, $lengthId);

        $orderToppingRepository->createMany($orderId, $toppings);

        header('Location: /order/show');
    }
}
