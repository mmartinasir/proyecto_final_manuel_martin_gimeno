<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Administracion de editoriales</title>
  </head>
  <body>
    <?php
      session_start();

      if (isset($_SESSION["admin"])) {
      } else {
        session_destroy();
        header("Location: userpanel.php");
      }
     ?>

     <?php

       $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
       $connection->set_charset("uft8");

       if ($connection->connect_errno) {
           printf("Connection failed: %s\n", $connection->connect_error);
           exit();
       }

       $query="SELECT * from editorial";
       if (isset($_POST["buscador"])) {
           $query="SELECT * from editorial where nombre like '%".$_POST["buscador"]."%'";
         };

       if ($result = $connection->query($query)) {

           printf("<p>%d autores encontrados.</p>", $result->num_rows);

       ?>
       <form class="" method="post">
         <input type="text" name="buscador" required>
         <input type="submit" name="" value="Buscar">
         <button type="button" onclick="window.location.href='admineditorial.php'"><span>Mostrar Todos</span></button><br><br>
         <button type="button" onclick="window.location.href='addeditorial.php'"><span>Nueva Editorial</span></button>

       </form><br><br>


      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Nombre</th>
      </thead>

      <?php

          while($obj = $result->fetch_object()) {
              echo "<tr>";;
                echo "<td>".$obj->nombre."</td>";
                echo "<td>"."<a href='editeditorial.php?cod=$obj->ideditorial'>"."<img src='../img/edit.png' style='width:40px;height:40px'>"."</td>";
                echo "<td>"."<a href='deleditorial.php?cod=$obj->ideditorial'>"."<img src='../img/delete.png' style='width:40px;height:40px'>"."</td>";
              echo "</tr>";
          }
          $result->close();
          unset($obj);
          unset($connection);
      }

    ?>
  </body>
</html>
