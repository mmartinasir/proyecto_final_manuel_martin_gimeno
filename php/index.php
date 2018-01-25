<?php

  //Open the session
  session_start();

  if (isset($_SESSION["usu"])) {
    //SESSION ALREADY CREATED
    //SHOW SESSION DATA
    var_dump($_SESSION);
  } else {
    session_destroy();
    header("Location: login.php");
  }


 ?>
