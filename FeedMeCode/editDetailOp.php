<?php
    session_start();
    $username = $_SESSION["userName"];
    //echo $username;
    $username2 = $_POST['Nickname'];
    //$password = $_POST['Password'];
    $password = do_hash($_POST['Password']);
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $address = $_POST['Address'];

    //echo $a;


    include ("DBConnection.class.php");
    $dbConn = new DBConnection();
    $id  = $_SESSION["userID"];

    if ($username == $username2){
        updateInfo($dbConn,$username2,$password,$email,$phone,$address,$id);
        echo "<script type='text/javascript'> alert('your information has been changed successfully!');window.location='myAccount.php';</script>";
    }
    else {
        $sql = "select * from Users where (Nickname= $username2) ";
        $res = $dbConn -> query($sql);
        $row = $res -> fetch_assoc();
        $_SESSION['userName']= $userName2;
        if($row){
            echo "<script type='text/javascript'> alert('This username exists!');history.go(-1);</script>";
            exit;
        }
        else{
            updateInfo($dbConn,$username2,$password,$email,$phone,$address,$id);
            echo "<script type='text/javascript'> alert('your information has been changed successfully!');window.location='myAccount.php';</script>";
        }
    }


    function updateInfo ($dbConn,$username, $password, $email, $phone, $address,$id){
       // $ps = do_hash($password);
        $sql="update Users set Nickname = '$username', Password = '$password', Email = '$email', Phone = '$phone', Address = '$address'where UserID = '$id'";
        //echo $sql;
        $dbConn -> query($sql);


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


