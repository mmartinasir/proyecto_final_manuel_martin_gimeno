<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Redirecting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<?php 

    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }

    if (isset($_SESSION["admin"])) {
        header("Location: adminedit.php");
    }

    if (isset($_SESSION["usu"])) {
        header("Location: useredit.php");
    }

?>
    
</body>
</html>