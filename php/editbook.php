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

    <?php if (!isset($_POST["titulo"])) : ?>

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
        echo "Error: El libro que se intenta editar no existe<br>";
        echo "<button onclick='history.go(-1);'>Volver</button>";
        exit();
      }


    ?>

      <form method="post">
        <fieldset>
          <legend>Editar Libro</legend>
          <span>IDlibro</span><input type="text" name="idlibro" value="<?php echo "$obj->idlibro";?>" disabled><br>
          <span>Titulo</span><input type="text" name="titulo" value="<?php echo "$obj->titulo";?>" required><br>
          <span>Paginas</span><input type="number" name="paginas" value="<?php echo "$obj->paginas";?>" required><br>
          <span>Fecha de Publicacion</span><input type="date" name="fecha" value="<?php echo "$obj->fecha_publicacion";?>"required ><br>
          <label for="editorial">Editorial</label>
          <select name="editorial">
            <?php $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
            $connection->set_charset("uft8");

            if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }


            $query2="SELECT ideditorial from libros where idlibro ='".$_GET["cod"]."'";

            if ($result = $connection->query($query2)) {

                $result->num_rows;

            $editorial = $result->fetch_object();

            $query="SELECT * from editorial";

            if ($result = $connection->query($query)) {

                $result->num_rows;

                while($obj = $result->fetch_object()) {
                  if ($obj->ideditorial == $editorial->ideditorial) {
                    echo "<option value='".$obj->ideditorial."' selected>".$obj->nombre."</option>";
                  } else {
                    echo "<option value='".$obj->ideditorial."'>".$obj->nombre."</option>";
                }

            }
          }
          }


          ?>
        </select><br>
          <label for="autor">Autor</label>
          <select name="autor">
            <?php $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
            $connection->set_charset("uft8");

            if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }


            $query2="SELECT idautor from libros where idlibro ='".$_GET["cod"]."'";

            if ($result = $connection->query($query2)) {

                $result->num_rows;

            $autor = $result->fetch_object();

            $query="SELECT * from autor";

            if ($result = $connection->query($query)) {

                $result->num_rows;

                while($obj = $result->fetch_object()) {
                  if ($obj->idautor == $autor->idautor) {
                    echo "<option value='".$obj->idautor."' selected>".$obj->nombre." ".$obj->apellidos."</option>";
                  } else {
                    echo "<option value='".$obj->idautor."'>".$obj->nombre." ".$obj->apellidos."</option>";
                }

            }
          }
          }


          ?>
        </select><br>
          <button type="submit" name="button">Editar</button>
          <button type="button" onclick="window.location.href='adminbook.php'">Cancelar</button>
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

    $query="UPDATE libros set titulo='".$_POST["titulo"]."', paginas='".$_POST["paginas"]."', fecha_publicacion='".$_POST["fecha"]."', ideditorial='".$_POST["editorial"]."', idautor='".$_POST["autor"]."' where idlibro =".$_GET["cod"];
    $buscartitulo = "SELECT * from libros where titulo ='".$_POST["titulo"]."'";
    
    if ($result = $connection->query($buscartitulo)) {
      $result->num_rows;
      if ($result->num_rows > 0) {
        echo "Error: Ese libro ya existe en la base de datos<br>";
        echo "<button onclick='history.go(-1);'>Volver</button>";
        exit();
      }
  }
    if ($result = $connection->query($query)) {

      header("Location: adminbook.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
