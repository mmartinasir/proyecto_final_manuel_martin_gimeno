<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      session_start();

      if (isset($_SESSION["admin"])) {
      } else {
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

   $query="DELETE from autor where idautor = '".$_GET["cod"]."'";

   if ($result = $connection->query($query)) {
 ?>

 <?php

       header("Location: adminautor.php", true, 301);
       exit();
}
  ?>

  </body>
</html>
