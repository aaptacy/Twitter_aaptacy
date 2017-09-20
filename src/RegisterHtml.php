<?php
session_start();
if (!isset($_SESSION['logowanie'])){
    header ('Location: TwitterHtml.php');
}
require 'Users.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SigningUp</title>
</head>
    <body>
        <form action="" method="POST">
    <label>Nazwa użytkownika:
        <input type="text" name="name">
    </label>
    <label>E-mail:
        <input type="text" name="email">
    </label>
    <label>Hasło:
        <input type="text" name="hash_pass">
    </label>
    <input type="submit" value="Zarejestruj">
</form>
<br>

    </body>
</html>