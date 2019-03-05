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

    <?php if (!isset($_POST["nombre"])) : ?>

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
					<li class="active"><a href="adminuser.php">Lista de usuarios</a></li>
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
					Añadir Usuario
				</div>
				<div class="panel-body">
        <form method="post">
          <span>Usuario </span><input type="text" name="usuario" required><br>
          <span>Nombre </span><input type="text" name="nombre" required><br>
          <span>Email </span><input type="email" name="email" required><br>
          <span>Telefono </span><input type="number" name="telefono" required><br>
          <span>Contraseña </span><input type="password" name="password" required><br>
          <button type="submit" name="button">Añadir</button>
          <button type="button" onclick="window.location.href='adminuser.php'">Cancelar</button>
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

    $pass=md5($_POST['password']);
    $buscarusuario = "SELECT * from usuarios where Usuario = '".$_POST["usuario"]."'";
    $buscaremail = "SELECT * from usuarios where email = '".$_POST["email"]."'";
    $query= "INSERT INTO usuarios (Usuario, Nombre, Email, Telefono, password, rol)
    VALUES('".$_POST['usuario']."','".$_POST['nombre']."','".$_POST['email']."','".$_POST['telefono']."','".$pass."','".'cliente'."')";

    if ($result = $connection->query($buscarusuario)) {
      $result->num_rows;
    };

    if ($result->num_rows > 0) {
      echo "Error: El usuario ya existe<br>";
      echo "<button onclick='history.go(-1);'>Volver</button>";
      exit();
    };

    if ($result = $connection->query($buscaremail)) {
      $result->num_rows;
    };

    if ($result->num_rows > 0) {
      echo "Error: El email está siendo utilizado por otro usuario<br>";
      echo "<button onclick='history.go(-1);'>Volver</button>";
      exit();
    };

    if ($result = $connection->query($query)) {

        header("Location: adminuser.php", true, 301);
        exit();
}
   ?>

    <?php endif ?>


  </body>
</html>
