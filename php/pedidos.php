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

      if (!isset($_SESSION["usu"])) {
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
       $query="SELECT * from pedidos join libros on libros.idlibro = pedidos.idlibro join usuarios on usuarios.idusuario = pedidos.idusuario where usuarios.idusuario = ".$_SESSION["id"]."";

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
					<li><a href="userpanel.php">Panel de Usuario</a></li>
					<li><a href="useredit.php?cod=<?php echo $_SESSION['id']?>">Editar Cuenta</a></li>
					<li class="active"><a href="pedidos.php">Mis pedidos</a></li>
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
					Mis pedidos
				</div>
				<div class="panel-body">
      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Fecha</th>
      </thead>
      </div>
			</div>
		</div>
	</div>
       
      <?php
          while($obj = $result->fetch_object()) {
              echo "<tr>";;
                echo "<td>".$obj->titulo."</td>";
                echo "<td>".$obj->fecha_pedido."</td>";
              echo "</tr>";
          }

          $result->close();
          unset($obj);
          unset($connection);

      }

    ?>
  </body>
</html>
