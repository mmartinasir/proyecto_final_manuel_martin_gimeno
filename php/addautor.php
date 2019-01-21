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
        session_destroy();
        header("Location: userpanel.php");
      }
     ?>

    <?php if (!isset($_POST["name"])) : ?>

      <form method="post">
        <fieldset>
          <legend>Añadir autor</legend>
          <span>Nombre </span><input type="text" name="name" required><br>
          <span>Apellidos </span><input type="text" name="surname" required><br>
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

    $query="INSERT into autor (nombre, apellidos) values ('".$_POST["name"]."','".$_POST["surname"]."')";

    if ($result = $connection->query($query)) {
  ?>

  <?php

        header("Location: adminautor.php", true, 301);
        exit();
}
   ?>

    <?php endif ?>


  </body>
</html>
