<?php
session_start();
if (!isset($_SESSION['logowanie'])){
    $_SESSION['logowanie'] = [];
}else{
    header ('Location: MainPageHtml.php');
}

$conn = new PDO("mysql:host=localhost;dbname=Twitter",'root','coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        try{
            $result = $conn->query('SELECT * FROM Users WHERE email = "'.$email.'";');
            foreach ($result as $row){
               if (password_verify($password, $row['hash_pass'])){
                    $_SESSION['logowanie'] = [$row['id'], $row['name'], $row['email']];
                   header("Location:MainPageHtml.php");
               }else{
                   echo 'Nieprawidłowy e-mail lub hasło'; 
               }       
            } 
        }catch (PDOException	$e){
            echo $e;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
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
        <a href="Register.php">Zarejestruj się</a>
    </body>
</html>