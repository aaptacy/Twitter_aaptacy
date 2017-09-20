<?php
session_start();
if(isset($_SESSION['logowanie'])){
    header("Location:MainPageHtml.php");
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
            if ($result->rowCount() === 0){
                echo 'Nieprawidłowe dane logowania';
            }
            foreach ($result as $row){
                if ((password_verify($password, $row['hash_pass'])) === true){
                    $_SESSION['logowanie'] = [$row['id'], $row['name'], $row['email']];
                    header("Location:MainPageHtml.php");
                }else{
                   echo 'Nieprawidłowe hasło'; 
                }       
            } 
        }catch (PDOException	$e){
            echo $e;
        }
    }
}
?>