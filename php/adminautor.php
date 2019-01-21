<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Administracion de autores</title>
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

       //CREATING THE CONNECTION
       $connection = new mysqli("localhost", "root", "Admin2015", "libreria");
       $connection->set_charset("uft8");

       //TESTING IF THE CONNECTION WAS RIGHT
       if ($connection->connect_errno) {
           printf("Connection failed: %s\n", $connection->connect_error);
           exit();
       }

       //MAKING A SELECT QUERY
       /* Consultas de selección que devuelven un conjunto de resultados */
       $query="SELECT * from autor";
       if (isset($_POST["buscador"])) {
         if ($_POST["opcion"]=="nombre") {
           $query="SELECT * from autor where nombre like '%".$_POST["buscador"]."%'";
         } elseif ($_POST["opcion"]=="apellidos") {
           $query="SELECT * from autor where apellidos like '%".$_POST["buscador"]."%'";
         }
       };

       if ($result = $connection->query($query)) {

           printf("<p>%d autores encontrados.</p>", $result->num_rows);

       ?>
       <form class="" method="post">
         <input type="text" name="buscador" value="Buscar autor" required>
         <input type="submit" name="" value="Buscar">
         <input type="radio" name="opcion" value="nombre"><label> Nombre</label>
         <input type="radio" name="opcion" value="apellidos"><label> Apellidos</label><br><br>
         <button type="button" onclick="window.location.href='addautor.php'"><span>Nuevo autor</span></button>

       </form><br><br>


      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
      </thead>

      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";;
                echo "<td>".$obj->nombre."</td>";
                echo "<td>".$obj->apellidos."</td>";
                echo "<td>"."<a href='editautor.php?cod=$obj->idautor'>"."<img src='../img/edit.png' style='width:40px;height:40px'>"."</td>";
                echo "<td>"."<a href='delautor.php?cod=$obj->idautor'>"."<img src='../img/delete.png' style='width:40px;height:40px'>"."</td>";
              echo "</tr>";
          }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
  </body>
</html>
