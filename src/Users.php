<?php

 
class Users{
    private $id;
    private $name;
    private $email;
    private $hash_pass;
    static public $conn; 

    public function __construct(){
        $this->id = null;
        $this->name = "";
        $this->email= "";
        $this->hash_pass = "";
        if(! self::$conn instanceof \PDO) {
            self::$conn = new PDO("mysql:host=localhost;dbname=Twitter",'root','coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        
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
        return $this->name = $name;
    }

    public function setEmail($email) {
        return $this->email = $email;
    }

    public function setHash_pass($newPass) {
        $newHashedPass = password_hash($newPass, PASSWORD_BCRYPT);
        return  $this->hash_pass = $newHashedPass;
    }
    
    public function saveToDB(PDO $conn){
            if($this->id == null && !empty($_POST['name']) &&  !empty($_POST['email']) && !empty($_POST['hash_pass'])){
                try{
                   $stmt = $conn->prepare('INSERT INTO Users (name, email, hash_pass) VALUES (:name, :email, :hash_pass);');
                    $result = $stmt->execute(
                        ['name' => $this->setName($_POST['name']),
                        'email' => $this->setEmail($_POST['email']),
                        'hash_pass' => $this->setHash_pass($_POST['hash_pass'])
                         ]);
                   if($conn->lastInsertId() != 0 ){;
                    echo 'Rejestracja przebiegła pomyślnie <a href="MainPageHtml.php">Przejdź do strony głównej</a>';
                   }
                }catch (PDOException $e){
                    echo 'Już istnieje użytkownik o podanym e-mailu';
                }
            }
            else{
                echo "Nie podano wszystkich wymaganych danych";
            }
    }
    
      public function modifyUser(PDO $conn){
                try{
                    //zapisać w sesji który użytkownik ma być wyedytowany
                   $stmt = $conn->prepare('UPDATE Users SET email=:email, hash_pass=:hash_pass WHERE id = 8;');
                   $result = $stmt->execute(
                        ['email'        => $this->setEmail($_POST['email']),
                         'hash_pass'    => $this->setHash_pass($_POST['hash_pass'])
                         ]);
                       echo 'Nowe dane zostały zapisane';
                }catch (PDOException $e){
                    echo 'Podany email jest zajęty';
                }
    }
    
     public function delete(PDO $conn){
                $key = $_POST['tableName'];
                $value = $_POST['searchfor'];
                try{
                   $result = $conn->query('DELETE FROM Users WHERE '.$key.' = "'.$value.'";');
                   if ($result->rowCount() != 0){
                        echo 'Usunięto użytkownika';
                    }else{
                        echo "Szukany użytkownik nie istnieje";
                    }
                }catch (PDOException	$e){      
                }
    }
    
    
    static public function loadBy(PDO $conn){
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
    
   
    static public function loadAllUsers(PDO $conn){ 
        try{
                $result = $conn->query('SELECT * FROM Users;');
                if ($result !== false){
                    foreach($result as $row) { 
                        $loadedUser = new Users; 
			$loadedUser->id = $row['id'];
			$loadedUser->name = $row['name'];
                        $loadedUser->hash_pass = $row['hash_pass'];
			$loadedUser->email = $row['email'];
			$ret[]=$loadedUser;
                    }
                }
                echo '<pre>';
                print_r ($ret);
                echo'</pre>';
                return $ret;
            }catch (PDOException $e){   
            }
    }
}
 if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$user = new Users; 
 }
if(strpos($_SERVER['HTTP_REFERER'], 'Register.php') != 0){
    $user->saveToDB(Users::$conn); 
}
elseif(strpos($_SERVER['HTTP_REFERER'], 'UserEditHtml.php') != 0){
    $user->modifyUser(Users::$conn); 
}
elseif (strpos($_SERVER['HTTP_REFERER'], 'SelectUserHtml.php') != 0){
        switch ($_POST['user']){
        case 'Szukaj':
            $user->loadBy(Users::$conn); 
            break;
        case 'Usuń (podaj id)':
            $user->delete(Users::$conn);
            break;
        case 'Wyświetl':
            $user->loadAllUsers(Users::$conn);
            break;
    }
} 

   
  
