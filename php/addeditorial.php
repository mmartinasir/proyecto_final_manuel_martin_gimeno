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
					<li><a href="adminbook.php">Libros</a></li>
					<li class="active"><a href="admineditorial.php">Editoriales</a></li>
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
					Añadir Editorial
				</div>
				<div class="panel-body">
        <form method="post">
          <span>Nombre </span><input type="text" name="name" required><br>
          <button type="submit" name="button">Añadir</button>
          <button type="button" onclick="window.location.href='admineditorial.php'">Cancelar</button>
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

    $repetido = "SELECT * from editorial where nombre = '".$_POST["name"]."'";
    $query="INSERT into editorial (nombre) values ('".$_POST["name"]."')";

    if ($result = $connection->query($repetido)) {
      $result->num_rows;
    }
    if ($result->num_rows > 0) {
      $_SESSION["repe"]=true;
        header("Location: admineditorial.php", true, 301);
        exit();
    }

    if ($result = $connection->query($query)) {

        header("Location: admineditorial.php", true, 301);
        exit();
    }
   ?>

    <?php endif ?>


  </body>
</html>
