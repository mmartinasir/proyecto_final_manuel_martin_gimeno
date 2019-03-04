<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="panel.css">
    <meta charset="utf-8">
    <title>Panel de Usuario</title>
  </head>
  <body>
    <?php
      session_start();

      if (!isset($_SESSION["usu"])) {
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
					<li><a href="useredit.php?cod=<?php echo $_SESSION['id']?>">Editar Cuenta</a></li>
					<li><a href="#">Mis pedidos</a></li>
					<li><a href="listbook.php">Libros disponibles</a></li>
					<li><a href="closesession.php">Cerrar sesion</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1>Panel de Usuario</h1>
			<p>Bienvenido, <?php echo $_SESSION["usu"] ?></p>
			<div class="panel-wrapper">
				<div class="panel-head">
					News
				</div>
				<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam fugiat culpa quia possimus molestiae id sapiente ad eveniet, aliquid, eum sint fuga eius, ratione suscipit ut minus voluptates dicta nesciunt.
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
