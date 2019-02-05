<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Panel de Administrador</title>
  </head>
  <body>
    <?php
      session_start();
      if (isset($_SESSION["admin"])) {
        echo "Bienvenido, ".$_SESSION["admin"];
      } else {
        header("Location: login.php");
      }
     ?>
    <div align = "center">
       <div style = "width:300px; border: solid 1px #333333; " align = "left">
          <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Panel de Administrador</b></div>

          <div style = "margin:30px">

            <div>
              <button class="button" style="vertical-align:middle"><span>Editar Cuenta</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle" onclick="window.location.href='adminuser.php'"><span>Lista de usuarios</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle" onclick="window.location.href='adminbook.php'"><span>Libros</span></button>

            </div>
            <div class="">
              <button class="button" style="vertical-align:middle" onclick="window.location.href='admineditorial.php'"><span>Editoriales</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle" onclick="window.location.href='adminautor.php'"><span>Autores</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle" onclick="window.location.href='closesession.php'"><span>Cerrar Sesion</span></button>
            </div>

          </div>

       </div>

    </div>
  </body>
</html>
