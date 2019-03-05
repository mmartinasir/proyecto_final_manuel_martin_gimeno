<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pedidos</title>
    <link rel="stylesheet" href="panel.css">
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
       $query="SELECT * from pedidos join libros on libros.idlibro = pedidos.idlibro join usuarios on usuarios.idusuario = pedidos.idusuario where pedidos.idusuario = ".$_GET["cod"]."";

       if ($result = $connection->query($query)) {

           printf("<p>%d Pedidos encontrados.</p>", $result->num_rows);

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
					<li><a href="closesession.php">Cerrar sesion</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1>Panel de Administrador</h1>
			<p>Bienvenido, <?php echo $_SESSION["admin"] ?></p>
			<div class="panel-wrapper">
				<div class="panel-head">
					News
				</div>
				<div class="panel-body">
                <table style="border:1px solid black">
                <thead>
                    <tr>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th>Borrar</th>
                </thead>
				</div>
			</div>
		</div>
	</div>
      <?php
          while($obj = $result->fetch_object()) {
              echo "<tr>";
                echo "<td>".$obj->titulo."</td>";
                echo "<td>".$obj->fecha_pedido."</td>";
                echo "<td>"."<a href='delpedido.php?cod=$obj->idpedido'>"."<img src='../img/delete.png' style='width:40px;height:40px'>"."</td>";
              echo "</tr>";
          }

          $result->close();
          unset($obj);
          unset($connection);

      }

    ?>
  </body>
</html>
