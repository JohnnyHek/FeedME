<?php
session_start();
include ("DBConnection.class.php");
$dbConn = new DBConnection();


$userID = $_SESSION["userID"];
$chatUserID = $_POST["chatUserID"];



$sql = "select * from ChatText where userID='$chatUserID' and ChatUserID='$userID' and status= 1 ";
$res = $dbConn ->query($sql);
$i=0;
$j=0;
while ($row = $res->fetch_assoc()){
    $idArr[$i++] = $row["ChatID"];
    $resArr[$j++] = $row;
}
$ids=implode(',',$idArr);


$sql2 = "update ChatText set Status = 2 where ChatID in ($ids)";
$dbConn->query($sql2);




echo json_encode($resArr);

?>
