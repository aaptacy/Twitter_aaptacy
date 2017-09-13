<?php

 
class Users{
    private $id;
    private $name;
    private $email;
    private $hash_pass;

    public function __construct(){
        $this->id = null;
        $this->name = "";
        $this->email= "";
        $this->hash_pass = "";
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getHash_pass() {
        return $this->hash_pass;
    }

    public function setName($name) {
        $this->name = $name;
        return $this->name;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this->email;
    }

    public function setHash_pass($newPass) {
        $newHashedPass = password_hash($newPass, PASSWORD_BCRYPT);
        $this->hash_pass = $newHashedPass;
        return $this->hash_pass;
    }
    
    public function saveToDB(){
        $conn = new PDO("mysql:host=localhost;dbname=Twitter",'root', 'coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($this->id == null && !empty($_POST['name']) &&  !empty($_POST['email']) && !empty($_POST['hash_pass'])){
                try{
                   $stmt = $conn->prepare('INSERT INTO Users (name, email, hash_pass) VALUES (:name, :email, :hash_pass);');
                    $result = $stmt->execute(
                        ['name' => $this->setName($_POST['name']),
                        'email' => $this->setEmail($_POST['email']),
                        'hash_pass' => $this->setHash_pass($_POST['hash_pass'])
                         ]);
                    if ($result !== false){
                    $this->id = $conn->lastInsertId();
                    echo 'Rejestracja przebiegła pomyślnie';
                    }
                }catch (PDOException	$e){
                   echo	"Już istnieje użytkownik o podanym e-mailu.";
                }
            }
            else{
                echo "Nie podano wszystkich wymaganych danych";
            };
        }
    }
    
    static public function loadBy(){
        $conn = new PDO("mysql:host=localhost;dbname=Twitter",'root', 'coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $key = $_POST['tableName'];
                $value = $_POST['searchfor'];
                try{
                   $result = $conn->query('SELECT * FROM Users WHERE '.$key.' = "'.$value.'";');
                   if ($result->rowCount() != 0){
                    foreach($result as $row) { 
                        echo "<pre>";
                        echo 'Id:'.$row['id'].', nazwa użytkownika: '.$row['name'].', e-mail: '.$row['email'];
                        echo "</pre>";
                    }
                    } else{
                        echo	"Szukany użytkownik nie istnieje";
                    }
                }catch (PDOException	$e){
                  
                }
        }
    }
    
    static public function loadAllUsers(){
       $conn = new PDO("mysql:host=localhost;dbname=Twitter",'root', 'coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            try{
                $result = $conn->query('SELECT * FROM Users;');
                if ($result !== false && $result->rowCount() != 0){
                    foreach($result as $row) { 
                        $loadedUser = new Users();
			$loadedUser->id	= $row['id'];
			$loadedUser->name = $row['name'];
                        $loadedUser->hash_pass = $row['hash_pass'];
			$loadedUser->email = $row['email'];
			$ret[]=$loadedUser;
                    }
                   }return $ret;
            }catch (PDOException	$e){
                  
                }
    }
}

$user = new Users; 
var_dump($user->loadAllUsers());
if(strpos($_SERVER['HTTP_REFERER'], 'Register.php') != 0){
   $user->saveToDB(); 
}
elseif (strpos($_SERVER['HTTP_REFERER'], 'SelectUserHtml.php') != 0){
       $user->loadBy();
} 

   
  
