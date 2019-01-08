<?php

  //Open the session
  session_start();

  if (isset($_SESSION["usu"])) {
    //SESSION ALREADY CREATED
    //SHOW SESSION DATA
    header("Location: userpanel.php");
  } else {
    session_destroy();
    header("Location: login.php");
  }


 ?>
