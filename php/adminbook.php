<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Buscador de libros</title>
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
       $query="SELECT * from libros";

       if (isset($_POST["buscador"])) {
         if ($_POST["opcion"]=="titulo") {
           $query="SELECT * from libros where titulo like '%".$_POST["buscador"]."%'";
         } elseif ($_POST["opcion"]=="editorial") {
           $query="SELECT * from libros join editorial on libros.IDeditorial = editorial.IDeditorial
           where editorial.Nombre like '%".$_POST["buscador"]."%'";
         } elseif ($_POST["opcion"]=="autor") {
           $query="SELECT * from libros join autor on libros.IDautor = autor.IDautor
           where autor.Nombre like '%".$_POST["buscador"]."%'";
         }

       };

       if ($result = $connection->query($query)) {

           printf("<p>%d Libros encontrados.</p>", $result->num_rows);

       ?>
       <form class="" method="post">
         <input type="text" name="buscador" value="Buscar libro" required>
         <input type="submit" name="" value="Buscar">
         <input type="radio" name="opcion" value="titulo"><label> Titulo</label>
         <input type="radio" name="opcion" value="editorial"><label> Editorial</label>
         <input type="radio" name="opcion" value="autor"><label> Autor</label>

       </form><br><br>


      <table style="border:1px solid black">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Paginas</th>
          <th>Fecha Publicacion</th>
      </thead>

      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";;
                echo "<td>".$obj->titulo."</td>";
                echo "<td>".$obj->paginas."</td>";
                echo "<td>".$obj->fecha_publicacion."</td>";
                echo "<td>"."<a href='editbook.php?cod=$obj->idlibro'>"."<img src='../img/edit.png' style='width:40px;height:40px'>"."</td>";
                echo "<td>"."<a href='delbook.php?cod=$obj->idlibro'>"."<img src='../img/delete.png' style='width:40px;height:40px'>"."</td>";
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
