<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      session_start();

      if (!isset($_SESSION["admin"])) {
        header("Location: login.php");
      }
     ?>

    <?php if (!isset($_POST["name"])) : ?>

      <form method="post">
        <fieldset>
          <legend>Añadir Editorial</legend>
          <span>Nombre </span><input type="text" name="name" required><br>
          <button type="submit" name="button">Añadir</button>
          <button type="button" onclick="window.location.href='admineditorial.php'">Cancelar</button>
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

    $repetido = "SELECT * from editorial where nombre = '".$_POST["name"]."'";
    $query="INSERT into editorial (nombre) values ('".$_POST["name"]."')";

    if ($result = $connection->query($repetido)) {
      $result->num_rows;
    }
    if ($result->num_rows > 0) {
      echo "Error: la editorial ya existe en la base de datos<br>";
      echo "<button onclick='history.go(-1);'>Volver</button>";
      exit();
    }

    if ($result = $connection->query($query)) {

        header("Location: admineditorial.php", true, 301);
        exit();
    }
   ?>

    <?php endif ?>


  </body>
</html>
