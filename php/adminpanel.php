<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Panel de Usuario</title>
  </head>
  <body>
    <?php
      session_start();
      if (isset($_SESSION["usu"])) {
        echo "Bienvenido, ".$_SESSION["usu"];
      } else {
        session_destroy();
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
              <button class="button" style="vertical-align:middle"><span>Lista de usuarios</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle"><span>Libros</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle"><span>Editoriales</span></button>
            </div>
            <div class="">
              <button class="button" style="vertical-align:middle"><span>Autores</span></button>
            </div>

          </div>

       </div>

    </div>
  </body>
</html>
