<?php
session_start();
include("DBConnection.class.php");
$dbconn  = new DBConnection();
$id  = $_SESSION["userID"];
//echo $id;
$sql="SELECT * FROM Users Where (UserID = '$id') ";
$res=$dbconn->query($sql);
$_SESSION['username']=$username;

if(!$dbconn){

    echo failed;

}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>User account details</title>
    <link href="FeedME.css" rel="stylesheet">
</head>

<body>

    <div class="title-page"> <h1 id="font1" >FeedME
            <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>

    <div class="login-page">
        <div class="form">
            <form action="editDetailOp.php" method="post">
    <table border=0 >
        <?php
        while($row=$res->fetch_assoc()){
            ?>

            <tr><td><h5>Username:</h5></td><td><input type="text"value="<?php echo $row['Nickname']?>" name="Nickname" size="20"> </td></tr>
            <tr><td><h5>Password:</h5></td><td><input type="text" value="" name="Password"size="20"></td></tr>
            <tr><td><h5>Confirm Password:</h5></td><td><input type="text" value="" name="Password1" size="20"></td></tr>
            <tr><td><h5>Email:</h5></td><td><input type="text" value="<?php echo $row['Email']?> " name="Email"size="20"></td></tr>
            <tr><td><h5>Phone:</h5></td><td><input type="text" value="<?php echo $row['Phone']?> " name="Phone"size="20"></td></tr>
            <tr><td><h5>Address:</h5></td><td><input type="text" value="<?php echo $row['Address']?>" name="Address"size="20"> </td></tr>



            <?php
        }
        ?>


    </table>

    <p><button>Confirm</button></p>
            </form>
        </div>
    </div>

</body>
</html>
