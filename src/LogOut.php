<?php
session_start();
unset($_SESSION['logowanie']);
header("Location: TwitterHtml.php");