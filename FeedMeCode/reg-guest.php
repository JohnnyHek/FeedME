<?php

$nickname = $_POST["Username"];
//$password1 = $_POST["Password1"];
$password1 = do_hash($_POST['Password1']);
//$password2 = $_POST["Password2"];
$password2 = do_hash($_POST['Password2']);
//$new_password = do_hash($_POST['Password']);
$email = $_POST["Email"];
$phone = $_POST["Phone"];
$address = $_POST["Address"];
$q = $_POST["question"];
$a = $_POST['Q'];

//$md5pass=md5(password1);

include("DBConnection.class.php");
$dbConn = new DBConnection();

if ($password1 == $password2) {
    $sql = "select * from Users where Nickname = '$nickname' ";
    $res = $dbConn -> query($sql);
    $row = $res ->fetch_assoc();
    if ($row) {

        echo "<script type='text/javascript'> alert('This username exists!');history.go(-1);</script>";
        exit;
    }
    else {
        $sql2 = "insert into Users (UserID,Email,Nickname,Password,Phone,Address,Question,Answer) values ('','$email','$nickname', '$password1','$phone','$address',$q,'$a')";
        //echo $sql2;
        $dbConn->query($sql2);
        echo "<script type='text/javascript'> alert('Success!');window.location = 'signIn.php';</script>";
    }

} else {
    echo "<script type='text/javascript'> alert('Two password should be the same');history.go(-1);</script>";
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

