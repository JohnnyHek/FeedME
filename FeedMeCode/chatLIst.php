<?php
$userID = $_SESSION["userID"];
$chatUserID = $_POST["chatUserID"];
include ("Chat.class.php");
include ("DBConnection.class.php");
$chat = new Chat();
$dbConn = new DBConnection();

$chat ->getChatText($dbConn,$userID,$chatUserID);
?>