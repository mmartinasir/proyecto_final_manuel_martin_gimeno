<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
  </head>
  <body>

    <?php
        //FORM SUBMITTED
        if (isset($_POST["user"])) {

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "usuario", "libreria");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from usuarios where
          usuario='".$_POST["user"]."' and passwd=md5('".$_POST["password"]."');";

          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {

              //No rows returned
              if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
              } else {
                //VALID LOGIN. SETTING SESSION VARS
                $_SESSION["usu"]=$_POST["user"];
                $_SESSION["language"]="es";

                header("Location: index.php");
              }

          } else {
            echo "Wrong Query";
          }
      }
    ?>
    <div align = "center">
       <div style = "width:300px; border: solid 1px #333333; " align = "left">
          <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

          <div style = "margin:30px">

             <form action = "" method = "post">
                <label>UserName  :</label><input type = "text" name = "user" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <input type = "submit" value = " Submit "/><br />
             </form>

          </div>

       </div>

    </div>

  </body>
</html>
