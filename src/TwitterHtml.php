<?php
if(isset($_SESSION['logowanie'])){
    header("Location:MainPageHtml.php");
}
require 'LogIn.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
    <body>
        <form action="" method="POST">
    <label>E-mail:
        <input type="text" name="email">
    </label>
    <label>Hasło:
        <input type="text" name="password">
    </label>
    <input type="submit" value="Zaloguj się">
</form>
<br>
        Nie masz konta?
        <a href="RegisterHtml.php">Zarejestruj się</a>
    </body>
</html>
