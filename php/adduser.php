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

      <form method="post">
        <fieldset>
          <legend>Añadir usuario</legend>
          <span>Usuario </span><input type="text" name="usuario" required><br>
          <span>Nombre </span><input type="text" name="nombre" required><br>
          <span>Email </span><input type="text" name="email" required><br>
          <span>Telefono </span><input type="number" name="telefono" required><br>
          <span>Contraseña </span><input type="password" name="password" required><br>
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

    $pass=md5($_POST['password']);
    $query= "INSERT INTO usuarios (Usuario, Nombre, Email, Telefono, password, rol)
    VALUES('".$_POST['usuario']."','".$_POST['nombre']."','".$_POST['email']."','".$_POST['telefono']."','".$pass."','".'cliente'."')";

    if ($result = $connection->query($query)) {
  ?>

  <?php

        header("Location: adminuser.php", true, 301);
        exit();
}
   ?>

    <?php endif ?>


  </body>
</html>
