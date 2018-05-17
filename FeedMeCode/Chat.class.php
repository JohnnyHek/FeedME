<?php
class Chat
{
    function showPage($dbConn, $userID)
    {
        $chatTempList = getChatTemp($dbConn, $userID);
        $i = 0;
        while ($row = $chatTempList->fetch_assoc()) {
            $userList[$i++] = $row;
            echo json_encode($userList);
        }

    }

    function newChat($dbConn, $userID, $chatUserID)
    {

        $sql = "select * from ChatTemp where UserID = '$userID' and ChatUserID = '$chatUserID'";
        $res = $dbConn->query($sql);
        $row = $res->fetch_assoc();
        $time = date("y-m-d h:i:s", time());

        if ($row) {
            $sql2 = "update ChatTemp set Time = '$time' where UserID = '$userID' and ChatUserID = '$chatUserID'";
            $dbConn->query($sql2);
        } else {
            $sql3 = "insert into ChatTemp(UserID,ChatUserID,Time) values ('$userID','chatUserID','$time')";
            $dbConn->query($sql3);
        }
    }

    function getChatText($dbConn, $userID, $chatUserID,$requestType)
    {

        switch ($requestType) {
            case 'get_message'://客户端请求读取消息
                break;
            case 'comfirm_read'://客户端确认已经读取了信息,服务端需要更新读取状态
                $idsArr = $_POST['send_data'];
                $ids = implode(',', $idsArr);
                $sql = "update message set status = 2 where id in ({$ids})";
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
                while ($row = $dbConn -> fetch_assoc($result)) {
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

    }

    function getChatTemp($dbConn, $userID)
    {
        $sql = "select * from ChatTemp where UserID = '$userID' order by Time desc";
        $res = $dbConn->query($sql);
        return $res;
    }

    function sendMessage($dbConn, $userID, $chatUserID, $text)
    {
        $time = date("y-m-d h:i:s", time());
        $sql = "insert into ChatText(UserID,ChatUserID,Time,Text,Status) values ($userID,$chatUserID,'$time','$text',1)";
        $res = $dbConn->query($sql);
        if($res){
            //$returnArr = [
                //'status'=> 1,
            //];
            echo 1;
        }
        else{
            //$ret = [
                //'status'=> 0,
            //];
            echo 0;
        }
        //echo json_encode($returnArr);
        exit ();
    }
}

?>