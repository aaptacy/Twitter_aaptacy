<?php

class Tweets{
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    static public $conn; 

    public function __construct(){
        $this->creationDate = time();
        if(! self::$conn instanceof \PDO) {
            self::$conn = new PDO("mysql:host=localhost;dbname=Twitter",'root','coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } 
    }
    
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getText() {
        return $this->text;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function setText($text) {
        return $this->text = $text;
    }

    function setCreationDate() {
         $this->creationDate = new DateTime();
         return $this->creationDate->format('Y-m-d H:i:s');
    }

    
    public function saveToDB(PDO $conn){
            if(!empty($_POST['text'])){
                try{
                   $stmt = $conn->prepare('INSERT INTO Tweets (user_id, text, creation_date) VALUES (:user_id, :text, :creation_date);');
                    $result = $stmt->execute(
                        ['user_id' => $_SESSION['logowanie'][0],
                         'text' => $this->setText($_POST['text']),
                         'creation_date' => $this->setCreationDate()
                         ]);
                   if($conn->lastInsertId() != 0 ){;
                    echo 'Tweet "'.$this->text.'"  dodany';
                   }
                }catch (PDOException $e){
                    echo $e;
                }
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
                
                try{
                    if($_POST['tableName'] == 'id'){
                        $result = $conn->query('SELECT * FROM Tweets t
                                        RIGHT JOIN Users
                                        ON t.user_id= Users.id
                                        WHERE t.id  ='.$_POST['searchfor'].';');
                    }else{
                        $result = $conn->query('SELECT * FROM Tweets t
                                        LEFT JOIN Users u
                                        ON t.user_id= u.id
                                        WHERE u.name ="'.$_POST['searchfor'].'";');
                    }                   
                   if ($result->rowCount() != 0){
                    foreach($result as $row) { 
                        echo "<pre>";
                        echo 'Użytkownik: '.$row['name'].' Id użytkownika: '.$row['id'].'  "'.$row['text'].'" w dniu: '.$row['creation_date'];
                        echo "</pre>";
                    }
                    } else{
                        echo	"Podany użytkownik lub tweet nie istnieje";
                    }
                }catch (PDOException	$e){      
                }
    }
    
   
   static public function loadAllTweets(PDO $conn){ 
        try{
                $result = $conn->query('SELECT * FROM Tweets;');
                if ($result !== false){
                    foreach($result as $row) { 
                        $result2 = $conn->query('SELECT * FROM Users WHERE id = '.$row['user_id'].';');
                        foreach($result2 as $row2){
			echo 'Użytkownik: '.$row2['name'].' w dniu:  '.$row['creation_date'].'  dodał Tweet:<br>'.$row['text'].'<br><br>';
                        } 
                    }
                }
            }catch (PDOException $e){ 
                echo $e;
            }
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$tweets = new Tweets; 
}

if(strpos($_SERVER['HTTP_REFERER'], 'MainPageHtml.php') != 0){
   $tweets->loadAllTweets(Tweets::$conn);
   $tweets->saveToDB(Tweets::$conn); 
}
elseif(strpos($_SERVER['HTTP_REFERER'], 'SelectTweet.php') != 0){
    $tweets->loadBy(Tweets::$conn); 
}

/*elseif (strpos($_SERVER['HTTP_REFERER'], 'SelectUserHtml.php') != 0){
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
 * 
 */

   
  

