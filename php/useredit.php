<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      session_start();
      if (!isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
      }
      
     ?>

    <?php if (!isset($_POST["nombre"])) : ?>

        <?php

      $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
      $connection->set_charset("uft8");

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      $query="SELECT * from usuarios where idusuario =".$_GET["cod"];

      if ($result = $connection->query($query)) {

          $result->num_rows;

      $obj = $result->fetch_object();

      }

      if ($result->num_rows==0) {
        header("Location: login.php");
        exit();
      }

      $comprobacion = $_SESSION["id"];
      $comprobacion2 = $obj->idusuario;

      if ($comprobacion != $comprobacion2) {
        header("Location: login.php");
        exit();
      }


    ?>

      <form method="post">
        <fieldset>
          <legend>Editar Cuenta</legend>
          <span>Nombre </span><input type="text" name="nombre" value="<?php echo "$obj->nombre";?>" required><br>
          <span>Email </span><input type="text" name="email" value="<?php echo "$obj->email";?>" required><br>
          <span>Telefono </span><input type="text" name="telefono" value="<?php echo "$obj->telefono";?>" required><br>
          <span>Contraseña </span><input type="password" name="password" required><br>
          <button type="submit" name="button">Editar</button>
          <button type="button" onclick="window.location.href='login.php'">Cancelar</button>

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

    $pass=md5($_POST['password']);
    $query="UPDATE usuarios set nombre='".$_POST["nombre"]."', email='".$_POST["email"]."', telefono='".$_POST["telefono"]."', password='".$pass."', where idusuario = '".$_GET["cod"]."'";

    if ($result = $connection->query($buscaremail)) {
      $result->num_rows;
  }
    if ($result->num_rows > 0) {
      if ($result = $connection->query($buscaremail2)) {
        $obj = $result->fetch_object();
        if ($obj->email != $_POST["email"]) {
          echo "Error: El email esta siendo utilizado por otro usuario<br>";
          echo "<button onclick='history.go(-1);'>Volver</button>";
          exit();
        }
      }
    }
    if (empty($_POST["password"])) {
      $query="UPDATE usuarios set nombre='".$_POST["nombre"]."', email='".$_POST["email"]."', telefono='".$_POST["telefono"]."' where idusuario = '".$_GET["cod"]."'";
    }
    if ($result = $connection->query($query)) {
      header("Location: login.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>
  </body>
</html>
