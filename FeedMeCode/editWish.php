<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13/05/2018
 * Time: 21:04
 */
include("DBConnection.class.php");
//$a = $_POST['arr'];
//echo $a;
$str = $_SERVER["QUERY_STRING"]."";
$arr = explode("=",$str);
$t = $arr[1];
//echo $t;
$res = explode(',',$t);

//for($index=0;$index<count($res);$index++)
//{
//    echo $res[$index];echo "</br>";
//}
$dbConn = new DBConnection();
//$id = '1';
session_start();
if (!empty($_SESSION["userID"])) {
$id  = $_SESSION["userID"];}

$sql1 = "SELECT * FROM FavouriteFood WHERE UserID='$id'";
$result1 = $dbConn->query($sql1);
//echo $result1;
$count = 0;
while($row1 = $result1->fetch_assoc())
{
    $count++;
}
//echo $count;
//$row = $result1->fetch_assoc();
if($count<1) {
    $flag = false;
}
else{
    $flag = true;
}
//echo $flag;
if($flag == true){
    //edit
    for($i=0;$i<count($res);$i++){
        $j = $i+1;
        $sql = "UPDATE FavouriteFood set `$j` = '$res[$i]' WHERE UserID='$id'";
        $result = $dbConn->query($sql);
        // echo $sql;
        if($result){
            //	$itemedited = 1;

            //echo "Updated Sussessfully";
            echo "<script type='text/javascript'>alert('Updated Sussessfully');window.location.href='wishList.php';</script>";

            // header("Location: wishList.php");

        }
    }
}
else{
    //add
    $sql2 = "INSERT into FavouriteFood (UserID,`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`,`19`) VALUES ('$id','$res[0]','$res[1]','$res[2]','$res[3]','$res[4]',
'$res[5]','$res[6]','$res[7]','$res[8]','$res[9]','$res[10]','$res[11]','$res[12]','$res[13]','$res[14]','$res[15]','$res[16]','$res[17]','$res[18]')";
    $result2 = $dbConn->query($sql2);
    // echo $sql;
    if($result2) {
        //	$itemedited = 1;
        echo "<script type='text/javascript'>alert('Add Sussessfully');window.location.href='wishList.php';</script>";
    }
}
//for($i=0;$i<count($res);$i++){
//    $j = $i+1;
//    $sql = "UPDATE FavouriteFood set `$j` = '$res[$i]' WHERE UserID='$id'";
//    $result = $dbConn->query($sql);
//   // echo $sql;
//    if($result){
//        //	$itemedited = 1;
//
//        //echo "Updated Sussessfully";
//        echo "<script type='text/javascript'>alert('Updated Sussessfully');window.location.href='wishList.php';</script>";
//
//       // header("Location: wishList.php");
//
//    }else{
//
//    }
//}
//if($flag == false){
//    $sql2 = "INSERT into FavouriteFood (UserID,`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`,`19`) VALUES ('$id','$res[0]','$res[1]','$res[2]','$res[3]','$res[4]',
//'$res[5]','$res[6]','$res[7]','$res[8]','$res[9]','$res[10]','$res[11]','$res[12]','$res[13]','$res[14]','$res[15]','$res[16]','$res[17]','$res[18]')";
//    $result2 = $dbConn->query($sql2);
//    // echo $sql;
//    if($result2) {
//        //	$itemedited = 1;
//        echo "<script type='text/javascript'>alert('Add Sussessfully');window.location.href='wishList.php';</script>";
//    }
//}

        ?>