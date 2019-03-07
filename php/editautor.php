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

    <?php if (!isset($_POST["name"])) : ?>

        <?php

      $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
      $connection->set_charset("uft8");

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      $query="SELECT * from autor where idautor =".$_GET["cod"];

      if ($result = $connection->query($query)) {

          $result->num_rows;

      $obj = $result->fetch_object();

      }

      if ($result->num_rows==0) {
        echo "Error: El autor que se intenta editar no existe";
        exit();
      }


    ?>
    <header>
		<div class="logo">Libre<span>ria</span></div>
	</header>
	<div class="nav-btn">Menu</div>
	<div class="container">
		
		<div class="sidebar">
			<nav>
				<a href="#">Libreria</a>
				<ul>
					<li class="active"><a href="adminpanel.php">Panel de Administrador</a></li>
					<li><a href="adminedit.php?cod=<?php echo $_SESSION['id']?>">Editar Cuenta</a></li>
					<li><a href="adminuser.php">Lista de usuarios</a></li>
					<li><a href="adminbook.php">Libros</a></li>
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
					Añadir Autor
				</div>
				<div class="panel-body">
      <form method="post">
          <span>IDautor</span><input type="text" name="idautor" value="<?php echo "$obj->idautor";?>" disabled><br>
          <span>Nombre</span><input type="text" name="name" value="<?php echo "$obj->nombre";?>" required><br>
          <span>Apellidos</span><input type="text" name="surname" value="<?php echo "$obj->apellidos";?>" required><br>
          <button type="submit" name="button">Editar</button>
          <button type="button" onclick="window.location.href='adminautor.php'">Cancelar</button>
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

    $buscarnombre = "SELECT * from autor where nombre ='".$_POST["name"]."'";
    $buscarnombre2 = "SELECT nombre from autor where idautor ='".$_GET["cod"]."'";
    $buscarapellido = "SELECT * from autor where apellidos ='".$_POST["surname"]."'";
    $buscarapellido2 = "SELECT apellidos from autor where idautor ='".$_GET["cod"]."'";
    $buscarnombrecompleto = "SELECT * from autor where nombre ='".$_POST["name"]."' and apellidos='".$_POST["surname"]."'";
    $query="UPDATE autor set nombre='".$_POST["name"]."', apellidos='".$_POST["surname"]."' where idautor = '".$_GET["cod"]."'";

    if ($result = $connection->query($buscarnombre)) {
      $result->num_rows;
  }
    if ($result->num_rows > 0) {
      if ($result = $connection->query($buscarnombre2)) {
        $obj = $result->fetch_object();
        if ($obj->nombre != $_POST["name"]) {
          $no1 = 1;
        } else {
          $no1 = 0;
        }
      }
    }
    if ($result = $connection->query($buscarapellido)) {
      $result->num_rows;
  }
    if ($result->num_rows > 0) {
      if ($result = $connection->query($buscarapellido2)) {
        $obj = $result->fetch_object();
        if ($obj->apellidos != $_POST["surname"]) {
          $no2 = 1;
        } else {
          $no2 = 0;
        }
      }
    }
    if ($no1 == 1 or $no2 == 1) {
      if ($result = $connection->query($buscarnombrecompleto)) {
        $result->num_rows;
        if ($result->num_rows > 0) {
          $_SESSION["repe"]=true;
          header("Location: adminautor.php", true, 301);
          exit();
        }
      }
    }
    

    if ($result = $connection->query($query)) {
      header("Location: adminautor.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
