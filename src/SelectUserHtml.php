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
    <title>Znajdź użytkownika</title>
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
                <a href ="MessagesHtml.php">Poczta</a>
            </td>
            <td>
                <a href="LogOut.php">Wyloguj się</a>
            </td>
        </tr>
        </table>
<div class="container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <form action="" method="post" role="form">
                <legend>Znajdź/usuń użytkownika</legend>
                <div class="form-group">
                    <label for="">Table</label>
                    <select name="tableName" id="tableName" class="form-control">
                    	<option value=""> -- Select table -- </option>
                    	<option value="id">Id</option>
                    	<option value="name">Nazwa użytkownika</option>
                    	<option value="email">E-mail</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Szukana fraza</label>
                    <input type="text" class="form-control" name="searchfor" id="searchfor"
                           placeholder="Wpisz zapytanie o użytkownika">
                </div>
                <input type="submit" name="user" value="Szukaj" class="btn btn-primary">
                <input type="submit" name="user" value="Usuń (podaj id)" class="btn btn-primary">
                <div class="form-group">
                    <label for="">Szukaj ręcznie - Wyświetl wszystkich użytkowików</label>
                    <br>
                <input type="submit" name="user" value="Wyświetl" class="btn btn-primary" id="searchfor">
                </div>
            </form>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>
</body>
</html>

 <?php
require ('Users.php');
?>

