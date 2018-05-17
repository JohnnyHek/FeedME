<?php
session_start();
include ("DBConnection.class.php");
$dbConn = new DBConnection();
$userID = $_SESSION['user'];
$chatUserID = $_POST["chatUserID"];
$text = $_POST["Text"];

function showPage($dbConn,$userID){
    $chatTempList = getChatTemp($dbConn,$userID);
    $i=0;
    while ($row = $chatTempList -> fetch_assoc()){
        $userList[$i++]=$row;
        echo json_encode($userList);
    }

}

function newChat($dbConn,$userID,$chatUserID){
    $sql = "select * from ChatTemp where UserID = '$userID' and ChatUserID = '$chatUserID'";
    $res = $dbConn -> query($sql);
    $row = $res -> fetch_assoc();
    $time = date("y-m-d h:i:s",time());

    if ($row){
        $sql2 = "update ChatTemp set Time = '$time' where UserID = '$userID' and ChatUserID = '$chatUserID'";
        $dbConn -> query($sql2);
    }
    else{
        $sql3 = "insert into ChatTemp(UserID,ChatUserID,Time) values ('$userID','chatUserID','$time')";
        $dbConn -> query($sql3);
    }
}

function getChatText($dbConn,$userID,$chatUserID){
    $sql = "select * from ChatText where userID = '$userID' and ChatUserID = '$chatUserID'";
    $res = $dbConn -> query($sql);
    $i = 0;
    while($row = $res -> fetch_assco()){
        $textList[$i++]=$row;
        echo json_encode($textList);
    }


}

function getChatTemp($dbConn,$userID){
    $sql = "select * from ChatTemp where UserID = '$userID' order by Time desc";
    $res = $dbConn -> query($sql);
    return $res;
}

function pushChat($dbConn,$userID,$chatUserID,$text){
    $time = date("y-m-d h:i:s",time());
    $sql = "insert into ChatText(UserID,ChatUserID,Time,ChatID,Text) values ($userID,$chatUserID,$time, ,$text)";
    $dbConn -> query($sql);
}

?>