<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" >
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

    <title><?= $title; ?> | Order 66</title>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a class="nav-title" href="/">Order 66</a>

            <ul class="nav-list">
                <a class="nav-link" href="/order">Order</a>
                <a class="nav-link" href="/user">Account</a>

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