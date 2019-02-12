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
          <legend>Añadir autor</legend>
          <span>Nombre </span><input type="text" name="name" required><br>
          <span>Apellidos </span><input type="text" name="surname" required><br>
          <button type="submit" name="button">Añadir</button>
          <button type="button" onclick="window.location.href='adminautor.php'">Cancelar</button>
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
    $buscarnombre = "SELECT * from autor where nombre = '".$_POST["name"]."'";
    $buscarapellido = "SELECT * from autor where apellidos = '".$_POST["surname"]."'";

  if ($result = $connection->query($buscarnombre)) {
    $result->num_rows;
    if ($result->num_rows > 0) {
      $obj = $result->fetch_object();
      $no1 = $obj->idautor;
    }
  }

  if ($result = $connection->query($buscarapellido)) {
    $result->num_rows;
    if ($result->num_rows > 0) {
      $obj = $result->fetch_object();
      $no2 = $obj->idautor;
    }
  }
  
  if ($no1 == $no2) {
    echo "Error: Ya existe ese autor en la base de datos<br>";
    echo "<button onclick='history.go(-1);'>Volver</button>";
    exit();
  }


  if ($result = $connection->query($query)) {

        header("Location: adminautor.php", true, 301);
        exit();
}
   ?>

    <?php endif ?>


  </body>
</html>
