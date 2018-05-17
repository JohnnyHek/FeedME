<?php
session_start();
$userID = $_SESSION["userID"];
include ("DBConnection.class.php");
$dbConn = new DBConnection();


//$userID = 1;


$sql = "select * from ChatTemp where UserID='$userID'";

$i = 0;
while (true) {
    $result = $dbConn -> query($sql);
    if ($result) {

        while ($row = $result -> fetch_assoc()) {
            $returnArr[] = $row;

        }
        if (!empty($returnArr)) {

            /*$data = [
                'response_type' => 'is_read',
                'info' => $returnArr,
                'userID'=>$userID,
            ];*/
            echo json_encode($returnArr);
            //$dbConn -> free_result($result);
            exit();
        }
    }
    $i++;
    $maxInvalidCount = 30;

    if ($i == $maxInvalidCount) {
        /*$data = [
            'status' => 1,
            'response_type' => 'is_connecting',
            'info' => '',
            'userID' => $userID,
        ];*/

        echo " ";
        exit();
    }

    sleep(1);
}

?>