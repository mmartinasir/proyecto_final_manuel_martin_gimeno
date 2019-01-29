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
          <span>Email </span><input type="text" name="email" value="<?php echo "$obj->email";?>" required><br>
          <span>Telefono </span><input type="text" name="telefono" value="<?php echo "$obj->telefono";?>" required><br>
          <span>Contraseña </span><input type="text" name="password" required><br>
          <span>Rol </span><input type="text" name="rol" value="<?php echo "$obj->rol";?>" required><br>
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

    $pass=md5($_POST['password']);
    $query="UPDATE usuarios set usuario='".$_POST["usuario"]."', nombre='".$_POST["nombre"]."', email='".$_POST["email"]."', telefono='".$_POST["telefono"]."', '".$pass."', rol='".$_POST["rol"]."' where idusuario = '".$_GET["cod"]."'";

    if ($result = $connection->query($query)) {
      header("Location: adminautor.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
