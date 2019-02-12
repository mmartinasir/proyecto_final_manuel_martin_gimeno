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

      if (!isset($_GET["cod"])) {
        header("Location: adminuser.php");
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

      if ($obj->rol == "admin") {
        header("Location: adminuser.php");
        exit();
      }

      if ($result->num_rows==0) {
        echo "Error: El usuario que se intenta editar no existe";
        exit();
      }


    ?>

      <form method="post">
        <fieldset>
          <legend>Editar Usuario</legend>
          <span>IDusuario</span><input type="text" name="idusuario" value="<?php echo "$obj->idusuario";?>" disabled><br>
          <span>Usuario </span><input type="text" name="usuario" value="<?php echo "$obj->usuario";?>" required><br>
          <span>Nombre </span><input type="text" name="nombre" value="<?php echo "$obj->nombre";?>" required><br>
          <span>Email </span><input type="email" name="email" value="<?php echo "$obj->email";?>" required><br>
          <span>Telefono </span><input type="text" name="telefono" value="<?php echo "$obj->telefono";?>" required><br>
          <span>Contraseña </span><input type="text" name="password"><br>
          <button type="submit" name="button">Editar</button>
          <button type="button" onclick="window.location.href='adminuser.php'">Cancelar</button>
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
    $buscarusuario = "SELECT * from usuarios where Usuario = '".$_POST["usuario"]."'";
    $buscarusuario2 = "SELECT usuario from usuarios where idusuario = '".$_GET["cod"]."'";
    $buscaremail = "SELECT * from usuarios where email = '".$_POST["email"]."'";
    $buscaremail2 = "SELECT email from usuarios where idusuario = '".$_GET["cod"]."'";
    $buscarpass = "SELECT password from usuarios where idusuario = '".$_GET["cod"]."'";
    $query="UPDATE usuarios set usuario='".$_POST["usuario"]."', nombre='".$_POST["nombre"]."', email='".$_POST["email"]."', telefono='".$_POST["telefono"]."', password='".$pass."' where idusuario = '".$_GET["cod"]."'";
    $query2="UPDATE usuarios set usuario='".$_POST["usuario"]."', nombre='".$_POST["nombre"]."', email='".$_POST["email"]."', telefono='".$_POST["telefono"]."' where idusuario = '".$_GET["cod"]."'";
    
    if ($result = $connection->query($buscarusuario)) {
      $result->num_rows;
  }
    if ($result->num_rows > 0) {
      if ($result = $connection->query($buscarusuario2)) {
        $obj = $result->fetch_object();
        if ($obj->usuario != $_POST["usuario"]) {
          echo "Error: El usuario ya existe<br>";
          echo "<button onclick='history.go(-1);'>Volver</button>";
          exit();
        }
      }
    }

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
    $query="UPDATE usuarios set usuario='".$_POST["usuario"]."', nombre='".$_POST["nombre"]."', email='".$_POST["email"]."', telefono='".$_POST["telefono"]."' where idusuario = '".$_GET["cod"]."'";
  }

    if ($result = $connection->query($query)) {
      header("Location: adminuser.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
