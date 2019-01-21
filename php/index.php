<?php

  //Open the session
  session_start();

  if (isset($_SESSION["usu"])) {
    header("Location: userpanel.php");
  } elseif (isset($_SESSION["admin"])) {
    header("Location: adminpanel.php");
  } else {
    session_destroy();
    header("Location: login.php");
  }


 ?>
