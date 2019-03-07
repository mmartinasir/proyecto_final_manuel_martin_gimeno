<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Buscador de libros</title>
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
					<li><a href="pedidos.php">Mis pedidos</a></li>
					<li class="active"><a href="listbook.php">Libros disponibles</a></li>
					<li><a href="closesession.php">Cerrar sesion</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1>Panel de Usuario</h1>
			<p>Bienvenido, <?php echo $_SESSION["usu"] ?></p>
			<div class="panel-wrapper">
				<div class="panel-head">
					Lista de libros
				</div>
				<div class="panel-body">
        <form class="" method="post">
         <input type="text" name="buscador" required>
         <input type="submit" name="" value="Buscar">
         <button type="button" onclick="window.location.href='listbook.php'"><span>Mostrar Todos</span></button>
         <input type="radio" name="opcion" value="titulo"><label> Titulo</label>
         <input type="radio" name="opcion" value="editorial"><label> Editorial</label>
         <input type="radio" name="opcion" value="autor"><label> Autor</label><br><br>
       </form><br><br>
       <div><?php 

                if (isset($_SESSION["repe"])) {
                  echo "<script type='text/javascript'>alert('Ya has pedido ese libro');</script>";
                  unset($_SESSION["repe"]);
                }

                if (isset($_SESSION["pedido"])) {
                  echo "<script type='text/javascript'>alert('Pedido realizado con exito');</script>";
                  unset($_SESSION["pedido"]);
                }
                  
              ?>
        </div>
      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Paginas</th>
          <th>Fecha Publicacion</th>
          <th>Autor</th>
          <th>Editorial</th>
          <th>Pedir libro</th>
      </thead>
      </div>
			</div>
		</div>
	</div>
      <?php

          while($obj = $result->fetch_object()) {
              echo "<tr>";;
                echo "<td>".$obj->titulo."</td>";
                echo "<td>".$obj->paginas."</td>";
                echo "<td>".$obj->fecha_publicacion."</td>";
                echo "<td>".$obj->autornombre." ".$obj->autorapellido."</td>";
                echo "<td>".$obj->editorialnombre."</td>";
                echo "<td>"."<a href='pedir.php?cod=$obj->idlibro'>"."<img src='../img/add.png' style='width:40px;height:40px'>"."</td>";
              echo "</tr>";
          }

          $result->close();
          unset($obj);
          unset($connection);

      }

    ?>
  </body>
</html>
