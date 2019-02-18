<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>

    <?php
  if (!isset($_POST["user"])) : ?>

  <form action = "" method = "post">
  <div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Registro</h1>
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
        <div class="control-group">
        <input type="text" class="login-field" placeholder="Nombre Completo" name="nombre">
        </div>
        <div class="control-group">
        <input type="email" class="login-field" placeholder="Email" name="email">
        </div>
        <div class="control-group">
        <input type="number" class="login-field" placeholder="Telefono" name="phone">
        </div>

				<input type="submit" class="btn btn-primary btn-large btn-block" value="Login">
				<a class="login-link" href="closesession.php">Cancelar</a>
			</div>
		</div>
  </div>
  </form>

          </div>

       </div>

    </div>

  <?php else: ?>

  <?php
        $connection = new mysqli("localhost", "root", "Admin2015", "libreria");

       //TESTING IF THE CONNECTION WAS RIGHT
       if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
      exit();
 }
    $buscarusuario = "select * from usuarios where Usuario = '".$_POST['user']."'";
    $buscaremail = "select * from usuarios where Email = '".$_POST['email']."'";

    if ($result = $connection->query($buscarusuario)) {

        //No rows returned
        if ($result->num_rows===0) {

        } else {
          echo "El usuario ya está registrado<br>";
          echo "<a href='register.php'>Volver al registro</a>";
          exit();
        }

    }

    if ($result = $connection->query($buscaremail)) {

        //No rows returned
        if ($result->num_rows===0) {

        } else {
          echo "El email ya está siendo utilizado por otro usuario.<br>";
          echo "<a href='register.php'>Volver al registro</a>";
          exit();
        }

    }

    $usuario=$_POST['user'];
    $pass=md5($_POST['password']);
    $consulta= "INSERT INTO usuarios (Usuario, Nombre, Email, Telefono, password, rol)
    VALUES('$usuario','".$_POST['nombre']."','".$_POST['email']."','".$_POST['phone']."','".$pass."','".'cliente'."')";

    $result = $connection->query($consulta);

    if (!$result) {
      echo "Error en la consulta. Contacte con un administrador.";
      var_dump($consulta);
   } else {
     $_SESSION["usu"]=$_POST["usuario"];
     header("Location: userpanel.php");
   }

 ?>

  <?php endif ?>




  </body>
</html>
