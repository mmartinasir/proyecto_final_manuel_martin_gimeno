<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="panel.css">
    <meta charset="utf-8">
    <title>Panel de Administrador</title>
  </head>
  <body>
    <?php
      session_start();
      if (!isset($_SESSION["admin"])) {
        header("Location: login.php");
      }
     ?>

    <?php

        $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
        $connection->set_charset("uft8");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $_SESSION["idusu"] = $_GET["cod"];
        $query="SELECT libros.*, editorial.nombre as editorialnombre, autor.nombre as autornombre, autor.apellidos as autorapellido from libros join editorial on editorial.ideditorial = libros.ideditorial join autor on autor.idautor = libros.idautor";
        if (isset($_POST["buscador"]) && isset($_POST['opcion'])) {
        if ($_POST["opcion"]=="titulo" ) {
            $query="SELECT libros.*, editorial.nombre as editorialnombre, autor.nombre as autornombre, autor.apellidos as autorapellido from libros join editorial on editorial.ideditorial = libros.ideditorial join autor on autor.idautor = libros.idautor where titulo like '%".$_POST["buscador"]."%'";
        } elseif ($_POST["opcion"]=="editorial") {
            $query="SELECT libros.*, editorial.nombre as editorialnombre, autor.nombre as autornombre, autor.apellidos as autorapellido from libros join editorial on editorial.ideditorial = libros.ideditorial join autor on autor.idautor = libros.idautor where editorial.Nombre like '%".$_POST["buscador"]."%'";
        } elseif ($_POST["opcion"]=="autor") {
            $query="SELECT libros.*, editorial.nombre as editorialnombre, autor.nombre as autornombre, autor.apellidos as autorapellido from libros join editorial on editorial.ideditorial = libros.ideditorial join autor on autor.idautor = libros.idautor where autor.Nombre like '%".$_POST["buscador"]."%'";
        }
        };

        if ($result = $connection->query($query)) {

            printf("<p>%d Libros encontrados.</p>", $result->num_rows);
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
					<li class="active"><a href="adminuser.php">Lista de usuarios</a></li>
					<li><a href="adminbook.php">Libros</a></li>
					<li><a href="admineditorial.php">Editoriales</a></li>
					<li><a href="adminautor.php">Autores</a></li>
					<li><a href="admipedidos.php">Lista de Pedidos</a></li>
					<li><a href="closesession.php">Cerrar sesion</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1>Panel de Administrador</h1>
			<p>Bienvenido, <?php echo $_SESSION["admin"] ?></p>
			<div class="panel-wrapper">
				<div class="panel-head">
					Añadir pedido
				</div>
				<div class="panel-body">
                <form class="" method="post">
         <input type="text" name="buscador" required>
         <input type="submit" name="" value="Buscar">
         <button type="button" onclick="window.location.href='addpedido.php?cod=$usu'"><span>Mostrar Todos</span></button>
         <input type="radio" name="opcion" value="titulo"><label> Titulo</label>
         <input type="radio" name="opcion" value="editorial"><label> Editorial</label>
         <input type="radio" name="opcion" value="autor"><label> Autor</label><br><br>
       </form><br><br>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
