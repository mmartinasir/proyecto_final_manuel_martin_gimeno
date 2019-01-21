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
        header("Location: login.php");
      }
     ?>

    <?php if (!isset($_POST["idlibro"])) : ?>

        <?php

      $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
      $connection->set_charset("uft8");

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      $query="SELECT * from libros where idlibro =".$_GET["cod"];

      if ($result = $connection->query($query)) {

          $result->num_rows;

      $obj = $result->fetch_object();

      }

      if ($result->num_rows==0) {
        echo "Error: El libro que se intenta editar no existe";
        exit();
      }


    ?>

      <form method="post">
        <fieldset>
          <legend>Editar Cliente</legend>
          <span>IDlibro</span><input type="text" name="idlibro" value="<?php echo "$obj->idlibro";?>" disabled><br>
          <span>Titulo</span><input type="text" name="titulo" value="<?php echo "$obj->titulo";?>" required><br>
          <span>Paginas</span><input type="text" name="paginas" value="<?php echo "$obj->paginas";?>" required><br>
          <span>Fecha de Publicacion</span><input type="date" name="fecha" value="<?php echo "$obj->fecha_publicacion";?>"required ><br>
          <span>Editorial</span><input type="text" name="nif" value="<?php echo "$obj->editorial";?>"><br>
          <span>Autor</span><input type="text" name="codc" value="<?php echo "$obj->autor"; ?>" disabled>
          <button type="submit" name="button">Editar</button>
        </fieldset>

      </form>
    <?php else : ?>

      <?php

    $connection = new mysqli("localhost", "tf", "123456", "tf");
    $connection->set_charset("uft8");

    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    $query="UPDATE clientes set dni='".$_POST["nif"]."', apellidos='".$_POST["lastname"]."', nombre='".$_POST["name"]."', Direccion='".$_POST["dir"]."', telefono='".$_POST["tel"]."' where CodCliente =".$_GET["cod"];

    if ($result = $connection->query($query)) {

      header("Location: clientes.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
