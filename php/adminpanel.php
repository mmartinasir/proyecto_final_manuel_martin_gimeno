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
					Novedades
				</div>
				<div class="panel-body">
					
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
