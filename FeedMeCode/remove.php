<?php
// sql command to remove a user from the 'Users' table in the database.
include("DBConnection.class.php");
$UserID=$_POST['UserID'];
mysqli_query($dbConn,"DELETE FROM Users WHERE UserID='$UserID'");
?>