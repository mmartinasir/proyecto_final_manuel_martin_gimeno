<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
    session_start();
    session_destroy();
    header("Location: login.php");
    ?>

  </body>
</html>
