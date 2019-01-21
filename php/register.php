<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
  </head>
  <body>

    <?php
  if (!isset($_POST["user"])) : ?>

    <div align = "center">
       <div style = "width:300px; border: solid 1px #333333; " align = "left">
          <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registro</b></div>

          <div style = "margin:30px">

             <form action = "" method = "post">
                <label>Usuario  :</label><input type = "text" name = "user" class = "box"/><br /><br />
                <label>Contraseña  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <label>Nombre completo  :</label><input type = "text" name = "nombre" class = "box" /><br/><br />
                <label>Email  :</label><input type = "text" name = "email" class = "box" /><br/><br />
                <label>Telefono  :</label><input type = "text" name = "phone" class = "box" /><br/><br />
                <input type = "submit" value = " Submit "/><br />
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
          echo "El usuario ya está registrado";
          exit();
        }

    }

    if ($result = $connection->query($buscaremail)) {

        //No rows returned
        if ($result->num_rows===0) {

        } else {
          echo "El email ya está siendo utilizado por otro usuario.";
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
       echo "Usuario creado con exito.";
   }

 ?>

  <?php endif ?>




  </body>
</html>
