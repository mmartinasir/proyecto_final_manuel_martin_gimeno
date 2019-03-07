<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Añadir autor</title>
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
          <span>Nombre </span><input type="text" name="name" required><br>
          <span>Apellidos </span><input type="text" name="surname" required><br>
          <button type="submit" name="button">Añadir</button>
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
    $query="INSERT into autor (nombre, apellidos) values ('".$_POST["name"]."','".$_POST["surname"]."')";
    $buscarnombre = "SELECT * from autor where nombre = '".$_POST["name"]."'";
    $buscarapellido = "SELECT * from autor where apellidos = '".$_POST["surname"]."'";
    $buscarnombrecompleto = "SELECT * from autor where nombre ='".$_POST["name"]."' and apellidos='".$_POST["surname"]."'";

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
