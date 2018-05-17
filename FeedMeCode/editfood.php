<?php
//This EDIT page replaces the User's old details in the database with new ones.
include("DBConnection.class.php");

$FoodID=$_POST['FoodID'];
$FoodName=$_POST['FoodName']; 
$FoodDescription=$_POST['FoodDescription'];
$FoodType=$_POST['FoodType'];
$Quantity=$_POST['Quantity'];
$Likes=$_POST['Likes'];
$SharerID=$_POST['SharerID'];
$ReleaseDate=$_POST['ReleaseDate'];
$LocationX=$_POST['LocationX'];
$LocationY=$_POST['LocationY'];


//Sql command to replace the old details with new ones.
mysqli_query($dbConn,"UPDATE Foods SET FoodID='$FoodID', FoodName = '$FoodName', FoodDescription = '$FoodDescription', FoodType = '$FoodType' , Quantity = '$Quantity', Likes = '$Likes' , SharerID = '$SharerID', ReleaseDate = '$ReleaseDate', LocationX = '$LocationX' , LocationY = '$LocationY' WHERE FoodID='$FoodID'");
?>
