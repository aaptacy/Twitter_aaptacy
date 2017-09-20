<?php
session_start();
if (!isset($_SESSION['logowanie'])){
    header ('Location: TwitterHtml.php');
}
if (strpos($_SERVER['HTTP_REFERER'],'ReceivedMessages.php') != 0){
    echo '<a href="ReceivedMessages.php">Wróć do Odebrane</a><br><br>';
}elseif (strpos($_SERVER['HTTP_REFERER'], 'SendedMessages.php') != 0) {
    echo '<a href="SendedMessages.php">Wróć do Wysłane</a><br><br>';
}

require 'Messages.php';

$message->loadSingleMessage(Messages::$conn);