<?php
//This EDIT page replaces the User's old details in the database with new ones.
include("DBConnection.class.php");

$UserID=$_POST['UserID'];
$Email=$_POST['Email']; 
$Nickname=$_POST['Nickname'];
$Phone=$_POST['Phone'];
$Address=$_POST['Address'];

//Sql command to replace the old details with new ones.
mysqli_query($dbConn,"UPDATE Users SET Email='$Email', Nickname = '$Nickname', Phone = '$Phone', 
	Address = '$Address' WHERE UserID='$UserID'");
?>
