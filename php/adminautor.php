<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Administracion de autores</title>
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

       $query="SELECT * from autor";
       if (isset($_POST["buscador"]) && isset($_POST['opcion'])) {
         if ($_POST["opcion"]=="nombre") {
           $query="SELECT * from autor where nombre like '%".$_POST["buscador"]."%'";
         } elseif ($_POST["opcion"]=="apellidos") {
           $query="SELECT * from autor where apellidos like '%".$_POST["buscador"]."%'";
         }
       };

       if ($result = $connection->query($query)) {

           printf("<p>%d autores encontrados.</p>", $result->num_rows);

       ?>
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
					<li><a href="admineditorial.php">Editoriales</a></li>
					<li class="active"><a href="adminautor.php">Autores</a></li>
					<li><a href="closesession.php">Cerrar sesion</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1>Panel de Administrador</h1>
			<p>Bienvenido, <?php echo $_SESSION["admin"] ?></p>
			<div class="panel-wrapper">
				<div class="panel-head">
					Lista de autores
				</div>
				<div class="panel-body">
       <form class="" method="post">
         <input type="text" name="buscador" required>
         <input type="submit" name="" value="Buscar">
         <button type="button" onclick="window.location.href='adminautor.php'"><span>Mostrar Todos</span></button>
         <input type="radio" name="opcion" value="nombre"><label> Nombre</label>
         <input type="radio" name="opcion" value="apellidos"><label> Apellidos</label><br><br>
         <button type="button" onclick="window.location.href='addautor.php'"><span>Nuevo autor</span></button>
       </form><br><br>
       <div><?php 

                if (isset($_SESSION["repe"])) {
                  echo "<script type='text/javascript'>alert('Ya existe ese autor en la base de datos');</script>";
                  unset($_SESSION["repe"]);
                }
                  
              ?>
        </div>
      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Editar</th>
          <th>Borrar</th>
      </thead>
       </div>
       </div>
       </div>
       </div>

      <?php

          while($obj = $result->fetch_object()) {
              echo "<tr>";;
                echo "<td>".$obj->nombre."</td>";
                echo "<td>".$obj->apellidos."</td>";
                echo "<td>"."<a href='editautor.php?cod=$obj->idautor'>"."<img src='../img/edit.png' style='width:40px;height:40px'>"."</td>";
                echo "<td>"."<a href='delautor.php?cod=$obj->idautor'>"."<img src='../img/delete.png' style='width:40px;height:40px'>"."</td>";
              echo "</tr>";
          }
          $result->close();
          unset($obj);
          unset($connection);
      }

    ?>
  </body>
</html>
