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
    <title>Komentarze</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <form action="" method="POST">
            <label>
                <textarea name="comment" rows = 3 cols = 40 placeholder="Wpisz komentarz..."></textarea>
                <br>
                <input type="submit" name="newcomment" value="Dodaj komentarz">
            </label>
        </form>
</body>
</html>
<?php
require('Comments.php');
?>