<?php

class Comments{
    private $id;
    private $userId;
    private $tweetId;
    private $text;
    private $creationDate;
    static public $conn; 

    public function __construct(){
        $this->id = null;
        $this->userId = null;
        $this->tweetId = null;
        $this->text = "";       
        $this->creationDate = time();
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

    public function getTweetId() {
        return $this->tweetId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setUserId($userId) {
        return $this->userId = $userId;
    }

    public function setTweetId($tweetId) {
       return $this->tweetId = $tweetId;
    }

    public function setText($text) {
        return $this->text = $text;
    }

    public function setCreationDate() {
        $this->creationDate = new DateTime();
        return $this->creationDate->format('Y-m-d H:i:s');
    }


    
    public function saveToDB(PDO $conn){
        if(!empty($_POST['comment'])){
            $stmt = $conn->prepare('INSERT INTO Comments (user_id, tweet_id, text, creation_date) VALUES (:user_id, :tweet_id, :text, :creation_date);');
            $stmt->bindValue(':user_id', $_GET['userid'], PDO::PARAM_INT);
            $stmt->bindValue(':tweet_id', $_GET['tweetid'], PDO::PARAM_INT);
            $stmt->bindValue(':text', $this->setText($_POST['comment'], PDO::PARAM_STR));
            $stmt->bindValue(':creation_date', $this->setCreationDate(), PDO::PARAM_STR);
            try{
                $result = $stmt->execute();
                echo 'Komentarz został dodany';
            }catch (PDOException $e){
                echo $e;
            }
        }
    }
    
    static public function loadAllComments(PDO $conn){ 
        try{
            $result = $conn->query('SELECT * FROM Comments WHERE tweet_id='.$_GET['tweetid'].' ORDER BY creation_date DESC;');
            if ($result !== false){
                foreach ($result as $row){
                    $result2 = $conn->query('SELECT * FROM Users WHERE id='.$row['user_id'].';');
                        foreach ($result2 as $row2){
                            echo 'Użytkownik '.$row2['name'].' w dniu: '.$row['creation_date'].' skomentował tweet:<br> "'.$row['text'].'"<br><br>';
                        }
                }
            }
        }catch (PDOException $e){ 
            echo $e;
        }
    }
}
    $comment = new Comments; 
    if(strpos($_SERVER['REQUEST_URI'], 'CommentsHtml.php') != 0){
       $comment->loadAllComments(Comments::$conn);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($_POST['comment'] != null){
                $comment->saveToDB(Comments::$conn); 
                $_POST['comment'] = null;
            }
        }
    }

   
  

