<?php
session_start();
if (!isset($_SESSION['logowanie'])){
    header ('Location: TwitterHtml.php');
}
require 'Messages.php';

$message->loadAllSended(Messages::$conn);