<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 05/05/2018
 * Time: 23:05
 */

include("DBConnection.class.php");
//echo "hi";
$upload = &$_POST['upload'];
session_start();
$dbConn = new DBConnection();
if($upload == "Upload Image"){
    $image = $_FILES['image']['tmp_name'];
    $name = $_FILES['image']['name'];
    $image = file_get_contents($image);
    $image = base64_encode($image);

    $_SESSION['photo'] = $image;


    $sql = "insert into images (name,image) values ('$name','$image')";
    $result = $dbConn->query($sql);
    if($result){
        header("Location: addItem2.php");
        echo "image uploaded";
    }
    else{
        echo "image not uploaded";
    }
}
else{
    $file = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $file = file_get_contents($file);
    $file = base64_encode($file);

    $_SESSION['file'] = $file;


    $sql = "insert into Files (Name,File) values ('$name','$file')";
    $result = $dbConn->query($sql);
    if($result){
        header("Location: addItem2.php");
        echo "file uploaded";
    }
    else{
        echo "file not uploaded";
    }
}



/*if(isset($_POST['submit'])){
    if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
        echo "Please select an image.";
    }
    else{
        $image = addslashes($_FILES['image']['tmp_name']);
        $name = addslashes($_FILES['image']['name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);
    }
    save($name,$image);

}
display();*/
function save($name,$image){
    $dbConn = new DBConnection();
    $sql = "insert into images (name,image) values ('$name','$image')";
    $result = $dbConn->query($sql);
    if($result){
        echo "image uploaded";
    }
    else{
        echo "image not uploaded";
    }
}

function display(){
    $dbConn = new DBConnection();
    $sql = "select * from images";
    $result = $dbConn->query($sql);
    while($row = $result->fetch_assoc())
    {
       // <img height="300" width="300" src="data:image;base64,''"
        echo '<img src="data:image;base64,'.$row["image"].'">';
    }
}