<?php
session_start();
if (!isset($_SESSION['logowanie'])){
    header ('Location: TwitterHtml.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edycja danych</title>
</head>
    <body>
        <table width = "300">
        <tr >
            <td  width = "130">
                <a href ="MainPageHtml.php">Strona główna</a>
            </td>
            <td>
                <a href ="MessagesHtml.php">Poczta</a>
            </td>
            <td>
                <a href="LogOut.php">Wyloguj się</a>
            </td>
        </tr>
        </table>
        <br>
        <br>        
        <form action="" method="POST">Wpisz nowe dane
            <div>
        <label>E-mail:
            <input type="text" name="email">
        </label>
        <label>Hasło:
            <input type="text" name="hash_pass">
        </label>
        <input type="submit" value="Edytuj">
        </div>
        </form>
        <br>
    </body>
</html>

        <?php require 'Users.php' ?>
