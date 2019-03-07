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
     <?php if (!isset($_POST["usuario"])) : ?>
    <?php

        $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
        $connection->set_charset("uft8");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $_SESSION["idusu"] = $_GET["cod"];
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
					Añadir pedido a usuario
				</div>
				<div class="panel-body">
                <form class="" method="post">
                <label for="usuario">Usuarios</label>
                <select name="usuario">
            <?php $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
            $connection->set_charset("uft8");

            if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }

            $query="SELECT * from usuarios where rol = 'cliente'";

            if ($result = $connection->query($query)) {

                $result->num_rows;

                while($obj = $result->fetch_object()) {
                    echo "<option value='".$obj->idusuario."'>".$obj->usuario."</option>";
                }

            }
          ?>
        </select>
        <button type="submit" name="button">Añadir</button>
       </form><br><br>
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

    $repetido = "SELECT * from pedidos where idlibro = ".$_GET["cod"]." and idusuario = ".$_POST["usuario"]."";
    $query="INSERT into pedidos (idlibro, idusuario, fecha_pedido) values (".$_GET["cod"].", ".$_POST["usuario"].", curdate())";

    if ($result = $connection->query($repetido)) {
      $result->num_rows;
    }
    if ($result->num_rows > 0) {
        $_SESSION["repe"]=true;
        header("Location: adminbook.php", true, 301);
        exit();
    }

    if ($result = $connection->query($query)) {
        $_SESSION["pedido"]=true;
        header("Location: adminbook.php", true, 301);
        exit();
    }
   ?>

    <?php endif ?>
  </body>
</html>
