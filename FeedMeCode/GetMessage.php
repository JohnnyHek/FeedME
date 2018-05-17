<?php


set_time_limit(0);
include ("DBConnection.class.php");
$dbConn = new DBConnection();


$userID = 1;
//$chatUserID = $_POST["chatUserID"];
//$requestType = $_POST['request_type'];
$chatUserID = 2;
$requestType = 'get_message';

switch ($requestType) {
    case 'get_message'://客户端请求读取消息
        break;
    case 'comfirm_read'://客户端确认已经读取了信息,服务端需要更新读取状态
        $idsArr = $_POST['send_data'];
        $ids = implode(',', $idsArr);
        $sql = "update ChatText set Status = 2 where ChatID in ($ids)";
        $dbConn -> query($sql);
        break;
    default:
        break;
}

$sql = "select * from ChatText where userID='$chatUserID' and ChatUserID='$userID' and status= 1 ";
$i = 0;
while (true) {
    //读取数据
    $result = $dbConn -> query($sql);
    if ($result) {
        $returnArr = [];

        while ($row = $result -> fetch_assoc()) {
            $returnArr[] = $row;

        }
        if (!empty($returnArr)) {
            //返回结果
            $data = [
                'status' => 1,
                'response_type' => 'is_read',
                'info' => $returnArr,
            ];
            echo json_encode($data);
            $dbConn -> free_result($result);
            exit();
        }
    }
    $i++;
    $maxInvalidCount = 30;
    //需要给客户端发送确认信息是否还在连接服务器,客户端无回应则整个过程结束
    if ($i == $maxInvalidCount) {
        $data = [
            'status' => 1,
            'response_type' => 'is_connecting',
            'info' => '',
        ];

        echo json_encode($data);
        exit();
    }

    sleep(1);
}

?>