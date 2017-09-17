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
</head>
    <body>
        <a href="SelectTweet.php">Przejdź do wyszukiwania Tweet'ów</a>
        <form action="" method="POST">
            <label>
                <textarea name="text" rows = 10 cols = 50 placeholder="Tweet..."></textarea>
                <input type="submit" name="newtweet" value="Tweet!">
            </label>
        </form>
    </body>
</html>
<?php
require 'Tweets.php';
?>