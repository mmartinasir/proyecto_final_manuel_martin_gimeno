<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      session_start();

      if (isset($_SESSION["admin"])) {
      } else {
        header("Location: userpanel.php");
      }
     ?>

    <?php if (!isset($_POST["name"])) : ?>

      <form method="post">
        <fieldset>
          <legend>Añadir Editorial</legend>
          <span>Nombre </span><input type="text" name="name" required><br>
          <button type="submit" name="button">Añadir</button>
        </fieldset>

      </form>
    <?php else : ?>

      <?php

    $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
    $connection->set_charset("uft8");

    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    $query="INSERT into editorial (nombre) values ('".$_POST["name"]."')";

    if ($result = $connection->query($query)) {
  ?>

  <?php

        header("Location: admineditorial.php", true, 301);
        exit();
}
   ?>

    <?php endif ?>


  </body>
</html>
