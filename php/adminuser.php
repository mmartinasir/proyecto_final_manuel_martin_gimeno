<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Administracion de usuarios</title>
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

       $query="SELECT * from usuarios where rol = 'cliente'";;
       if (isset($_POST["buscador"]) && isset($_POST['opcion'])) {
         if ($_POST["opcion"]=="nombre") {
           $query="SELECT * from usuario where nombre like '%".$_POST["buscador"]."%'";
         } elseif ($_POST["opcion"]=="usuario") {
           $query="SELECT * from usuario where usuario like '%".$_POST["buscador"]."%'";
         }
       };

       if ($result = $connection->query($query)) {

           printf("<p>%d usuarios encontrados.</p>", $result->num_rows);

       ?>
       <form class="" method="post">
         <input type="text" name="buscador" required>
         <input type="submit" name="" value="Buscar">
         <button type="button" onclick="window.location.href='adminuser.php'"><span>Mostrar Todos</span></button>
         <input type="radio" name="opcion" value="nombre"><label> Nombre</label>
         <input type="radio" name="opcion" value="usuario"><label> Usuario</label><br><br>
         <button type="button" onclick="window.location.href='adduser.php'"><span>Nuevo usuario</span></button>

       </form><br><br>


      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Telefono</th>
      </thead>

      <?php

          while($obj = $result->fetch_object()) {
              echo "<tr>";;
                echo "<td>".$obj->usuario."</td>";
                echo "<td>".$obj->nombre."</td>";
                echo "<td>".$obj->email."</td>";
                echo "<td>".$obj->telefono."</td>";
                echo "<td>"."<a href='edituser.php?cod=$obj->idusuario'>"."<img src='../img/edit.png' style='width:40px;height:40px'>"."</td>";
                echo "<td>"."<a href='deluser.php?cod=$obj->idusuario'>"."<img src='../img/delete.png' style='width:40px;height:40px'>"."</td>";
              echo "</tr>";
          }
          $result->close();
          unset($obj);
          unset($connection);
      }

    ?>
  </body>
</html>
