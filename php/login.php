<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>
    <?php
      if (isset($_SESSION["admin"])) {
        header("Location: adminpanel.php");
      } elseif (isset($_SESSION["usu"])) {
        header("Location: userpanel.php");
      };
     ?>

    <?php
        //FORM SUBMITTED
        if (isset($_POST["user"])) {

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "libreria");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $pass=md5($_POST['password']);
          $consulta="select * from usuarios where
          usuario='".$_POST["user"]."' and password='$pass'";

          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                $incorrecto = "Usuario o contraseña incorrectos";
              } else {
                //VALID LOGIN. SETTING SESSION VARS
                $usuario = $result->fetch_object();
                $_SESSION["language"]="es";

                if ($usuario->rol == "admin") {
                  $_SESSION["admin"]=$_POST["user"];
                  $_SESSION["id"]=$usuario->idusuario;
                  header("Location: adminpanel.php");
                } else {
                  $_SESSION["usu"]=$_POST["user"];
                  $_SESSION["id"]=$usuario->idusuario;
                  header("Location: userpanel.php");
                }
              }
          } else {
            echo "Wrong Query";
          }
      }
    ?>
    <body>
  <form action = "" method = "post">
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Login</h1>
			</div>

			<div class="login-form">
				<div class="control-group">
				<input type="text" class="login-field" value="" placeholder="Usuario" id="login-name" name="user">
				<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="control-group">
				<input type="password" class="login-field" value="" placeholder="Contraseña" id="login-pass" name="password">
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>

				<input type="submit" class="btn btn-primary btn-large btn-block" value="Login">
				<a class="login-link" href="register.php">Registro</a>
			</div>
		</div>
  </div>
    </form>
</body>
  </body>
</html>
