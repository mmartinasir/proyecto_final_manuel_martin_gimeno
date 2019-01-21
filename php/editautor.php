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

        <?php

      $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
      $connection->set_charset("uft8");

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      $query="SELECT * from autor where idautor =".$_GET["cod"];

      if ($result = $connection->query($query)) {

          $result->num_rows;

      $obj = $result->fetch_object();

      }

      if ($result->num_rows==0) {
        echo "Error: El autor que se intenta editar no existe";
        exit();
      }


    ?>

      <form method="post">
        <fieldset>
          <legend>Editar Autor</legend>
          <span>IDautor</span><input type="text" name="idautor" value="<?php echo "$obj->idautor";?>" disabled><br>
          <span>Nombre</span><input type="text" name="name" value="<?php echo "$obj->nombre";?>" required><br>
          <span>Apellidos</span><input type="text" name="surname" value="<?php echo "$obj->apellidos";?>" required><br>
          <button type="submit" name="button">Editar</button>
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

    $query="UPDATE autor set nombre='".$_POST["name"]."', apellidos='".$_POST["surname"]."' where idautor = '".$_GET["cod"]."'";

    if ($result = $connection->query($query)) {
      header("Location: adminautor.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
