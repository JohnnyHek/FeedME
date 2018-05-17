<?php
session_start();
include("DBConnection.class.php");
$dbConn = new DBConnection();
$q=$_POST['question'];
$a= $_POST['Q'];
$username=$_POST['userName'];
if($q == "" || $a== ""  ) {
    echo "<script type='text/javascript'>alert('Sorry! You answered incorrectly!'); history.go(-1);</script>";
}else{
    $sql = "select * from Users where (Nickname='$username') AND (Question= '$q') AND (Answer= '$a')";
    $res = $dbConn -> query($sql);
    $row = $res -> fetch_assoc();
    if($row) {
        $sql1 = "select UserID from Users where (Nickname='$username') AND (Question= '$q') AND (Answer= '$a')";
        $res1 = $dbConn -> query($sql1);

        $i = 0;
        while($row1 = $res1->fetch_assoc())
        {
            $resultshown[$i++] = $row["UserID"];
        }
        $userID = $resultshown[0];
        $_SESSION['userID']=$userID;
        //echo $userID;
        $_SESSION["userName"] = $username;
        echo "<script type='text/javascript'>alert('Answer correctly!');window.location = 'editDetails.php';</script>";
    }
    else
    {
        echo "<script type='text/javascript'>alert('Answers are incorrect, please try again!');history.go(-1);</script>";
    }
}
