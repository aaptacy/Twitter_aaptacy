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
    <title>Strona główna</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
    <body>
        <table width = "400">
        <tr >
            <td  width = "150">
                 <a href="SelectTweet.php">Szukaj Tweet'ów</a>
            </td>
            <td>
                <a href ="MessagesHtml.php">Poczta</a>
            </td>
            <td>
                <a href="UserEditHtml.php">Edytuj dane</a>
            </td>
            <td>
                <a href="LogOut.php">Wyloguj się</a>
            </td>
        </tr>
        </table>
        <br>
       
        <br>
        <form action="" method="POST">
            <label>
                <textarea name="text" rows = 3 cols = 50 placeholder="Tweet..."></textarea>
                <input type="submit" name="newtweet" value="Tweet!">
            </label>
        </form>
    </body>
</html>
<?php
echo '<br>';
require 'Tweets.php';
?>