<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="panel.css">
  </head>
  <body>

    <?php
      session_start();

      if (!isset($_SESSION["admin"])) {
        header("Location: login.php");
      }
     ?>

    <?php if (!isset($_POST["titulo"])) : ?>

    <header>
		<div class="logo">Libre<span>ria</span></div>
	</header>
	<div class="nav-btn">Menu</div>
	<div class="container">
		
		<div class="sidebar">
			<nav>
				<a href="#">Libreria</a>
				<ul>
					<li><a href="adminpanel.php">Panel de Administrador</a></li>
					<li><a href="useredit.php?cod=<?php echo $_SESSION['id']?>">Editar Cuenta</a></li>
					<li><a href="adminuser.php">Lista de usuarios</a></li>
					<li class="active"><a href="adminbook.php">Libros</a></li>
					<li><a href="admineditorial.php">Editoriales</a></li>
					<li><a href="adminautor.php">Autores</a></li>
					<li><a href="closesession.php">Cerrar sesion</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1>Panel de Administrador</h1>
			<p>Bienvenido, <?php echo $_SESSION["admin"] ?></p>
			<div class="panel-wrapper">
				<div class="panel-head">
					Añadir Libro
				</div>
				<div class="panel-body">
        <form method="post">
          <span>Titulo </span><input type="text" name="titulo" required><br>
          <span>Paginas </span><input type="number" name="paginas" required><br>
          <span>Fecha de Publicacion</span><input type="date" name="fecha" required><br>
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
          <button type="submit" name="button">Añadir</button>
          <button type="button" onclick="window.location.href='adminbook.php'"><span>Cancelar</span></button>
      </form>
      </div>
			</div>
		</div>
	</div>

      
    <?php else : ?>

      <?php

    $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
    $connection->set_charset("uft8");

    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    $query="INSERT into libros (titulo, paginas, fecha_publicacion, ideditorial, idautor) values ('".$_POST["titulo"]."','".$_POST["paginas"]."','".$_POST["fecha"]."','".$_POST["editorial"]."','".$_POST["autor"]."')";
    $buscartitulo = "SELECT * from libros where titulo ='".$_POST["titulo"]."'";

    if ($result = $connection->query($buscartitulo)) {
      $result->num_rows;
      if ($result->num_rows > 0) {
        $_SESSION["repebook"]=true;
        header("Location: adminbook.php", true, 301);
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
