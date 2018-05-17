<?php
session_start();
if (!empty($_SESSION["userID"])) {
//$id  = $_SESSION["userID"];

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link href="FeedME.css" rel="stylesheet">

    <title>FeedME</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="wishList.js"></script>

</head>
<body>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
<div class="login-page">

    <div class="form">

<h2>My Wishlist</h2>
<div class="favourite">

</div>

<div>
    <form action="editWishlist.php" method="post">
    <button>Add/Edit My Preference</button>
    </form>
</div>
</div>

</div>

</body>
</html>
    <?php

}
else{

    echo "<script type='text/javascript'>alert('Please sign in.');window.location.href='signIn.php';</script>";
}
?>