<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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

   $repetido = "SELECT * from pedidos where idusuario = ".$_SESSION["id"]." and idlibro = ".$_GET["cod"]."";
   $query="INSERT into pedidos (idlibro, idusuario, fecha_pedido) values (".$_GET["cod"].",".$_SESSION["id"].", curdate())";

    if ($result = $connection->query($repetido)) {
    $result->num_rows;
    if ($result->num_rows > 0) {
      $_SESSION["repe"]=true;
      header("Location: listbook.php", true, 301);
      exit();
    }
}

   if ($result = $connection->query($query)) {
 ?>

 <?php
        $_SESSION["pedido"] = true;
        header("Location: listbook.php", true, 301);
        exit();
}
  ?>

  </body>
</html>
