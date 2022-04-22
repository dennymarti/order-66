<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" >

    <title><?= $title; ?> | Order 66</title>
  </head>
  <body>
    <header class="header">
        <nav class="nav d-flex align-items-center justify-content-between">
            <a class="nav-title" href="/">Order 66</a>

            <ul class="nav-list">
                <a class="nav-link" href="#">Bestellen</a>
                <a class="nav-link" href="/user">Konto</a>

                <?php
                if(isset($isLoggedIn) && $isLoggedIn) {
                    echo "<a class='nav-link nav-button' href='/auth/logout'>Logout</a>";
                } else {
                    echo "<a class='nav-link nav-button' href='/auth/login'>Login</a>";
                }
                ?>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="wrapper">
