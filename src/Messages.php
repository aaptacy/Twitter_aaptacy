<?php

class Messages{
    private $id;
    private $senderId;
    private $receiverId;
    private $message;
    private $creationDate;
    private $indicator;
    static public $conn; 

    public function __construct(){
        $this->id = null;
        $this->senderId = null;
        $this->receiverId = null;
        $this->message = "";       
        $this->creationDate = "";
        $this->indicator = 1;
        if(! self::$conn instanceof \PDO) {
            self::$conn = new PDO("mysql:host=localhost;dbname=Twitter",'root','coderslab',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } 
    }
    
    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getIndicator() {
        return $this->indicator;
    }

    public function setSenderId($senderId) {
        return $this->senderId = $senderId;
    }

    public function setReceiverId($receiverId) {
        return $this->receiverId = $receiverId;
    }

    public function setMessage($message) {
        return $this->message = $message;
    }

    public function setCreationDate() {
        $this->creationDate = new DateTime();
        return $this->creationDate->format('Y-m-d H:i:s');
    }

    public function setIndicator($indicator) {
        $this->indicator = $indicator;
    }
    
    public function saveToDB(PDO $conn){    
        if(isset($_POST['message']) && strlen(trim($_POST['message'])) > 0 && isset($_POST['receiver'])){
            if ($_POST['receiver'] === $_SESSION['logowanie'][1]){
                echo "Nie możesz wysłać wiadomości do siebie";
                return false;
            }
            try{
                $result=$conn->query('SELECT * FROM Users WHERE email ="'.$_POST['receiver'].'";');
                foreach($result as $row){
                    $receiver = $row['name'];
                    $receiverID = $row['id'];
                }
            }catch (PDOException $e){
                echo $e;
            }
            $stmt = $conn->prepare('INSERT INTO Messages (sender_id, receiver_id, message, creation_date, indicator) VALUES (:sender_id, :receiver_id, :message, :creation_date, :indicator);');
            $stmt->bindValue(':sender_id', $_SESSION['logowanie'][0], PDO::PARAM_INT);
            $stmt->bindValue(':receiver_id',$receiverID, PDO::PARAM_INT);
            $stmt->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
            $stmt->bindValue(':creation_date', $this->setCreationDate(), PDO::PARAM_STR);
            $stmt->bindValue(':indicator', $this->getIndicator(), PDO::PARAM_INT);
            try{
                $result2 = $stmt->execute();
                echo 'Wiadomość została wysłana';
            }catch (PDOException $e){
                echo $e;
            }
        }
    }
    
    static public function loadAllSended(PDO $conn){ 
        try{
            $result = $conn->query('SELECT * FROM Messages WHERE sender_id = '.$_SESSION['logowanie'][0].' ORDER BY creation_date DESC;');
            if ($result !== false){
                foreach ($result as $row){
                    $result2 = $conn->query('SELECT * FROM Users WHERE id='.$row['receiver_id'].';');
                        foreach ($result2 as $row2){
                            echo 'Do '.$row2['name'].' w dniu: '.$row['creation_date'].'<br>';
                            echo '<a href="SingleMessage.php?id='.$row['id'].'&receiver='.$row2['name'].'">'.substr($row['message'],0,30).'...</a><br><br>';
                        }
                   }
                }
            }catch (PDOException $e){ 
                echo $e;
            }
    }
    
   static public function loadAllReceived(PDO $conn){ 
        try{
            $result = $conn->query('SELECT * FROM Messages WHERE receiver_id = '.$_SESSION['logowanie'][0].' ORDER BY creation_date DESC;');
            if ($result !== false){
                foreach ($result as $row){
                    $result2 = $conn->query('SELECT * FROM Users WHERE id='.$row['sender_id'].';');
                        foreach ($result2 as $row2){
                            echo 'Od '.$row2['name'].' w dniu: '.$row['creation_date'].'<br>';
                            if ($row['indicator'] == 1){
                                echo '<a href="SingleMessage.php?indicator=0&id='.$row['id'].'&sender='.$row2['name'].'"><b>'.substr($row['message'],0,30).'...</b></a><br><br>';  
                                try{
                                    $result=$conn->query('UPDATE Messages SET indicator=0 WHERE id='.$row['id'].';');  
                                }catch (PDOException $e) {
                                    echo $e;
                                }
                            }else{
                                echo '<a href="SingleMessage.php?indicator=0&id='.$row['id'].'&sender='.$row2['name'].'">'.substr($row['message'],0,30).'...</a><br><br>';
                            }
                        }
                    }
            }
        }catch (PDOException $e){ 
            echo $e;
        }
    }
    
    static public function loadSingleMessage(PDO $conn){   
        try{
            $result = $conn->query('SELECT * FROM Messages WHERE id='.$_GET['id'].';');
            foreach($result as $row){
                $result2 = $conn->query('SELECT * FROM Users WHERE id='.$row['receiver_id'].';');
                foreach($result2 as $row2){
                    if (strpos($_SERVER['HTTP_REFERER'], 'ReceivedMessages.php') != 0){
                        echo 'Nadawca: '.$_GET['sender'].'<br>Odbiorca: '.$row2['name'].'<br>Treść: "'.$row['message'].'"';  
                    }elseif (strpos($_SERVER['HTTP_REFERER'], 'SendedMessages.php') !=0) {
                        echo 'Nadawca: '.$_SESSION['logowanie'][1].'<br>Odbiorca: '.$row2['name'].'<br>Treść: "'.$row['message'].'"';  
                    }
                  
                }  
            }
        }catch (Exception $ex) {
            echo $e;
        }
    }
}

$message = new Messages; 
$message->saveToDB(Messages::$conn); 


   
  

