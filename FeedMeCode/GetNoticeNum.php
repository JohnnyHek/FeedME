<?php
    session_start();
    include("DBConnection.class.php");
    $userID = $_SESSION['userID'];
   // $userID = 4;
    $sql = "select * from Notice where UserID = '$userID' AND Status = '1'";
    $dbConn = new DBConnection();
    $res = $dbConn ->query($sql);
    $num = 0;
    while($row = $res -> fetch_assoc()){
        $num++;
    }
    //echo $sql;
   echo $num;
    exit;

?>