<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/05/2018
 * Time: 17:17
 */
//echo "hello";
session_start();
include("DBConnection.class.php");
$a = $_POST['action'];
$dbConn = new DBConnection();
if (!empty($_SESSION["userID"])) {
    $id = $_SESSION["userID"];
}
else{
    $id = null;
}
//$id = '1';
//echo $id;




    $sql = "select * from FavouriteFood where UserID = {$id}";
    $result = $dbConn->query($sql);

    $f_array = array();
//$row = $result->fetch_assoc();
//echo $row;
//$i = 0;
    while($row = $result->fetch_assoc()) {

        for($i=1;$i<20;$i++){
            // echo $row[$i];
            if($row[$i]=='1'){
                array_push($f_array,$i);
                //   echo $i;
            }
        }
    }

    $sql2 = "select * from FoodType";
    $result2 = $dbConn->query($sql2);
    $t_array = array();
    while($row2 = $result2->fetch_assoc())
    {
        for($j=0;$j<sizeof($f_array);$j++){
            //  echo $f_array[$j];
            if($f_array[$j] == $row2[TypeID]){
                //    echo $row2[TypeName];
                //echo "hi";
                array_push($t_array,$row2[TypeName]);
            }
        }
    }

//echo $t_array;
if(isset($_SESSION["Favourite"])){
    $_SESSION["Favourite"]=$t_array;
}else{
    $_SESSION["Favourite"]=$t_array;
}

    echo  json_encode($t_array);



?>