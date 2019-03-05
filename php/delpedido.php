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

   $query="DELETE from pedidos where idpedido = '".$_GET["cod"]."'";

   if ($result = $connection->query($query)) {
 ?>

 <?php

       header("Location: adminuser.php", true, 301);
       exit();
}
  ?>

  </body>
</html>
