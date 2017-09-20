<?php
session_start();
if (!isset($_SESSION['logowanie'])){
    header ('Location: TwitterHtml.php');
}
require('Messages.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wiadomości</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
        <table width = "300">
        <tr >
            <td  width = "130">
                <a href ="MainPageHtml.php">Strona główna</a>
            </td>
            <td>
                <a href="LogOut.php">Wyloguj się</a>
            </td>
        </tr>
    </table>
    <form action="" method="POST">
        <label>Nowa wiadomość<br>
                <textarea name="message" rows = 3 cols = 43 placeholder="Wpisz wiadomość..."></textarea>
                <br>
                Do:<input type="text" name="receiver">
                <input type="submit" name="send" value="Wyślij wiadomość">
            </label>
        </form>

    <a href="SendedMessages.php">Wysłane wiadomości</a>
    <a href="ReceivedMessages.php">Odebrane wiadomości</a>
</body>
</html>
