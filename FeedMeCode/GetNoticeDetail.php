<?php
session_start();
$userID = $_SESSION['userID'];
include ("DBConnection.class.php");
$dbConn = new DBConnection();


//$userID = 4;
$requestType = $_POST['request_type'];


switch ($requestType) {
    case 'get_notice':
        break;
    case 'comfirm_read':
        $idsArr = $_POST['send_data'];
        $ids = implode(',', $idsArr);
        $sql = "update Notice set Status = 2 where ID in ($ids)";
        $dbConn -> query($sql);
        break;
    default:
        break;
}

$sql = "select * from Notice where userID='$userID'and Status = '1'";
$i = 0;
while (true) {
    
    $result = $dbConn -> query($sql);
    if ($result) {
        //$returnArr = [];

        while ($row = $result -> fetch_assoc()) {
            $returnArr[] = $row;

        }
        if (!empty($returnArr)) {
            
            /*$data = [
                'status' => 1,
                'response_type' => 'is_read',
                'info' => $returnArr
            ];*/
			
			//$data='{"status":"1","response_type":"is_read","info":'+json_encode($returnArr)+'}';
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
            'info' => ''
			];*/
		
		//$data='{"status":"1","response_type":"is_connecting","info":" "}';
        echo " ";
        exit();
    }

    sleep(1);
}

?>