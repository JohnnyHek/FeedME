
<?php
session_start();
$userID = $_SESSION["userID"];
$chatUserID=$_POST["chatUserID"];
$text=$_POST["message"];


include ("DBConnection.class.php");

$dbConn = new DBConnection();


$time = date("y-m-d h:i:s", time());
$sql = "insert into ChatText(UserID,ChatUserID,Time,Text,Status) values ($userID,$chatUserID,'$time','$text',1)";
$res = $dbConn->query($sql);
saveChatTemp($dbConn,$userID,$chatUserID,$time);
if($res){
            $returndata=1;
        }
        else{
            $returndata=0;
        }
        //echo json_encode($returnArr);
		echo $returndata;



function saveChatTemp($dbConn,$userID,$chatUserID,$time){
    $sql = "insert into ChatTemp(UserID,ChatUserID,Time) values ($userID,$chatUserID,'$time')";
    $dbConn -> query($sql);
    $sql2 = "insert into ChatTemp(UserID,ChatUserID,Time) values ($chatUserID,$userID,'$time')";
    $dbConn -> query($sql2);
}
?>