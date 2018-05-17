<?php
// sql command to remove a user from the 'Foods' table in the database.
include("DBConnection.class.php");
$FoodID=$_POST['FoodID'];
mysqli_query($dbConn,"DELETE FROM Foods WHERE FoodID='$FoodID'");
?>