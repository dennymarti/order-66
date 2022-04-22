<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" >

    <title><?= $title; ?> | Bbc MVC</title>
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">Bbc MVC</a>
          <?php
          if(isset($isLoggedIn) && $isLoggedIn) {
              echo "<span class='text-light'>Welcome USER</span>
                    <a class='btn btn-danger' href='/auth/logout'>Logout</a>
                    ";
          } else {
              echo "<form method='post' action='/auth'>
                      <input type='text' name='username'>
                      <input type='password' name='password'>
                      <button type='submit'>Login</button>
                    </form>";
          }
          ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user">User</a>
            </li>
          </ul>
      </nav>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <main class="container">
      <h1><?= $heading; ?></h1>
    </main>
  </body>
</html>
