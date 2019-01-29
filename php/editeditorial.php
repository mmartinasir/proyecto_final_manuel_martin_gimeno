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

      $query="SELECT * from editorial where ideditorial =".$_GET["cod"];

      if ($result = $connection->query($query)) {

          $result->num_rows;

      $obj = $result->fetch_object();

      }

      if ($result->num_rows==0) {
        echo "Error: La editorial que se intenta editar no existe";
        exit();
      }


    ?>

      <form method="post">
        <fieldset>
          <legend>Editar Autor</legend>
          <span>IDeditorial</span><input type="text" name="idautor" value="<?php echo "$obj->ideditorial";?>" disabled><br>
          <span>Nombre</span><input type="text" name="name" value="<?php echo "$obj->nombre";?>" required><br>
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

    $query="UPDATE editorial set nombre='".$_POST["name"]."' where ideditorial = '".$_GET["cod"]."'";

    if ($result = $connection->query($query)) {
      header("Location: admineditorial.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
