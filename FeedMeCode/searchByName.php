<?php
include("DBConnection.class.php");
$database='Xcqnl46_FeedME';
$fn = $_GET['q1'];
mysqli_select_db($database);
$sql = "SELECT * FROM Foods  WHERE (FoodName = '$fn')";
if(mysqli_query($sql)){
    $result = mysqli_query("SELECT * FROM Foods");

}
echo " success";

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>search by food name</title>
    <link href="FeedME.css" rel="stylesheet">
</head>

<body>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" value = "Home" onClick="javascript:location.href='index.php'"></h1>
    <div  class="myAccount">
        <select name="myAccount" onchange="window.location=this.value;">
            <option  hidden>My Account</option>
            <option value="signIn.php" class="op1">Sign in</option>
            <option value="register.php" class="op1">Register</option>
            <option value="myAccount.php">My Profile</option>
            <option value="mySharing.php">My Sharing</option>
            <option value="message.php">Message</option>
            <option value="wishList.php">Wish List</option>
        </select>
    </div>
</div>

<div class="content">
    <div class="con1">
     <span><img src="location.jpg" alt="location" id="picLocation">
         <input type="button" value="My Location" id="myLocation"></span>
    </div>

    <div class="con2">
        <span><input type="text" placeholder="Name" id="FoodName"></span>
        <span><input type="text" placeholder="Type"></span>
        <span><input type="text" placeholder="Quantity"></span>
        <span><input type="text" placeholder="Location"></span>
        <span><input type="button" value="Search" onclick="searchByName()"></span>
    </div>

    <div class="con2">
    <span>
        <select name="sort" onchange=sorting(this.value)>
            <option hidden>Sorting</option>
            <option>Distance close to far</option>
            <option>Distance far to close</option>
            <option>Latest release</option>
            <option>Most popular</option>

        </select>
    </span>

        <span>
        <select name="filter" onchange=filtering(this.value)>
            <option hidden>Filter</option>
            <option>Release today</option>
            <option>Release within 3 days</option>
            <option>Release within 5 days</option>
            <option>Location within 500m</option>
            <option>Location within 1km</option>
            <option>Location within 3km</option>
        </select>
    </span>
    </div>

    <div class="con2">
        <div class="form3">
            <table id="table" >

                <?php
                while($row = mysqli_fetch_array($result)){
                    ?>

                    <tr><td><h5>Photo</h5></td><td><h5>FoodName</h5></td></tr>
                    <tr><td><?php echo $row['Photo']?></td>
                        <td><a href="itemPage.php" target="_blank"><u><?php echo $row['FoodName']?>  </u></a></td>
                    </tr>
                    <?php
                }
                ?>



            </table>
        </div>

    </div>
</div>
</body>
</html>


