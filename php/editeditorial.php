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

      $query="SELECT * from editorial where ideditorial =".$_GET["cod"];

      if ($result = $connection->query($query)) {

          $result->num_rows;

      $obj = $result->fetch_object();

      }

      if ($result->num_rows==0) {
        echo "Error: La editorial que se intenta editar no existe<br>";
        echo "<button onclick='history.go(-1);'>Volver</button>";
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
					Editar Editorial
				</div>
				<div class="panel-body">
        <form method="post">
          <span>IDeditorial</span><input type="text" name="idautor" value="<?php echo "$obj->ideditorial";?>" disabled><br>
          <span>Nombre</span><input type="text" name="name" value="<?php echo "$obj->nombre";?>" required><br>
          <button type="submit" name="button">Editar</button>
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

    $query="UPDATE editorial set nombre='".$_POST["name"]."' where ideditorial = '".$_GET["cod"]."'";
    $buscarnombre = "SELECT * from editorial where nombre ='".$_POST["name"]."'";

    if ($result = $connection->query($buscarnombre)) {
      $result->num_rows;
      if ($result->num_rows > 0) {
        $_SESSION["repe"]=true;
        header("Location: admineditorial.php", true, 301);
        exit();
      }
  }
    if ($result = $connection->query($query)) {
      header("Location: admineditorial.php", true, 301);
      exit();
  }
  ?>

    <?php endif ?>


  </body>
</html>
