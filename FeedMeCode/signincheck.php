<?php
    session_start();
    include("DBConnection.class.php");
    $dbConn = new DBConnection();
    $user = $_POST['Nickname'];
    $pwd = do_hash($_POST['Password']);
    //$pwd = $_POST['Password'];
    //$pwd = password_hash($p, PASSWORD_BCRYPT);
    //$hash_password = password_hash($password, PASSWORD_BCRYPT);
    //echo $pwd;
   // $p = $_POST['Password'];
    //$pwd = do_hash($_POST['Password1']);


    if($user == "" || $pwd == "") {
        echo "<script type='text/javascript'>alert('Please enter username or password!'); history.go(-1);</script>";
    }
    else {
        $sql = "select * from Users where (Nickname = '$user') and (Password = '$pwd')";
        $res = $dbConn -> query($sql);
        $row = $res -> fetch_assoc();

         if($row) {
             $sql1 = "select UserID from Users where (Nickname = '$user') and Password = '$pwd'";
             $res1 = $dbConn -> query($sql1);

             $i = 0;
             while($row = $res1->fetch_assoc())
             {
                 $resultshown[$i++] = $row["UserID"];
             }
             $userID = $resultshown[0];
             $_SESSION['userID']=$userID;
             $_SESSION['userName']=$user;
             //echo $userID;
             echo "<script type='text/javascript'>alert('Login successfully!');window.location = 'index.php';</script>";

            //echo $userID;
            //echo "<script type='text/javascript'>alert('Login successfully!');window.location = 'index.php';</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('Username or password is incorrect, please try again!');history.go(-1);</script>";
        }
    }


?>

<?php
function do_hash($pwd){
$salt ='ladjkdjqo2wipkj';
return md5($pwd.$salt);
}
//$char= "myblog";
//$md5_char = md5($char);
//$salt_char = do_hash($char);
//echo "md5-char is: $md5_char;;;;;";
//echo "salt-char is: $salt_char";
?>

