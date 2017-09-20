<?php

class Tweets{
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    static public $conn; 

    public function __construct(){
        $this->id = null;
        $this->userId = null;
        $this->text = "";       
        $this->creationDate = "";
        if(! self::$conn instanceof \PDO) {
            self::$conn = new PDO("mysql:host=localhost;dbname=Twitter",'root','coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } 
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setText($text) {
        return $this->text = $text;
    }

    public function setCreationDate() {
         $this->creationDate = new DateTime();
         return $this->creationDate->format('Y-m-d H:i:s');
    }

    
    public function saveToDB(PDO $conn){
            if(!empty($_POST['text'])){
                $stmt = $conn->prepare('INSERT INTO Tweets (user_id, text, creation_date) VALUES (:user_id, :text, :creation_date);');
                $stmt->bindValue(':user_id',$_SESSION['logowanie'][0], PDO::PARAM_INT);
                $stmt->bindValue(':text',$this->setText($_POST['text']), PDO::PARAM_STR);
                $stmt->bindValue(':creation_date',$this->setCreationDate(), PDO::PARAM_STR);
                try{
                    $result = $stmt->execute();
                    echo 'Tweet został dodany';
                    }catch (PDOException $e){
                    echo $e;
                }
            }
    }
    
    static public function loadBy(PDO $conn){            
        try{
            if($_POST['tableName'] == 'id'){
                $result = $conn->query('SELECT * FROM Tweets t
                                        RIGHT JOIN Users u
                                        ON t.user_id= u.id
                                        WHERE t.id  ='.$_POST['searchfor'].';');
            }elseif ($_POST['tableName'] === 'name'){
                $result = $conn->query('SELECT * FROM Tweets t
                                        LEFT JOIN Users u
                                        ON t.user_id= u.id
                                        WHERE u.name ="'.$_POST['searchfor'].'";');
            }                   
            if ($result->rowCount() != 0){
                foreach($result as $row){ 
                    echo 'Użytkownik: '.$row['name'].' o id: '.$row['id'].' dodał tweeta o id: '.$row[0].' "'.$row['text'].'" w dniu: '.$row['creation_date'].'<br>';
                }
            }else{
                echo	"Tweet nie istnieje lub podany użytkownik nie dodał jeszcze żadnego tweeta";
            }
        }catch (PDOException	$e){  
            echo $e;
        }
    }
    
   
   static public function loadAllTweets(PDO $conn){ 
        try{
            $result = $conn->query('SELECT * FROM Tweets ORDER BY creation_date DESC;');
            if ($result !== false){
                foreach($result as $row) { 
                    $result2 = $conn->query('SELECT * FROM Users WHERE id = '.$row['user_id'].';');
                    foreach($result2 as $row2){
			echo 'Użytkownik: '.$row2['name'].' w dniu:  '.$row['creation_date'].'  dodał Tweet:<br>'.$row['text'].'<br>';
                        echo '<a href = "CommentsHtml.php?userid='.$row2['id'].'&tweetid='.$row[0].'">Dodaj komentarz</a><br><br>';
                    } 
                }
            }
        }catch (PDOException $e){ 
            echo $e;
        }
    }
}

$tweets = new Tweets; 

if(strpos($_SERVER['REQUEST_URI'], 'MainPageHtml.php') != 0){
    $tweets->loadAllTweets(Tweets::$conn);
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && strlen($_POST['text']) > 0){
        $tweets->saveToDB(Tweets::$conn);  
    } 
}elseif(strpos($_SERVER['REQUEST_URI'], 'SelectTweet.php') != 0){
    $tweets->loadBy(Tweets::$conn); 
}


   
  

