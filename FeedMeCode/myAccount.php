<?php
session_start();
include("DBConnection.class.php");
$dbconn  = new DBConnection();
//$id  = $_SESSION["userID"];
if (!empty($_SESSION["userID"])) {
    $id  = $_SESSION["userID"];
    $sql="SELECT * FROM Users Where (UserID = '$id') ";
    $res=$dbconn->query($sql);
    if(!$dbconn){

        echo failed;

    }
   // $t = implode("##",$selected_type);
    ?>

    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>User account details</title>
        <link href="FeedME.css" rel="stylesheet">
        <script>


        </script>
    </head>

    <body>
    <center>
        <div class="title-page"> <h1 id="font1" >FeedME
                <input type="submit" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
        <div class="login-page">
            <div class="form"><form action="editDetails.php" method="post">
                    <p><label><h4>My Personal Details</h4></label>
                    <table border="0">

                        <?php
                        while($row=$res->fetch_assoc()){
                            ?>
                            <tr><td><h5>UserID:</h5></td><td><?php echo $row['UserID']?></td></tr>
                            <tr><td><h5>Username:</h5></td><td><?php echo $row['Nickname']?> </td></tr>
                            <tr><td><h5>Email:</h5></td><td><?php echo $row['Email']?> </td></tr>
                            <tr><td><h5>Phone:</h5></td><td><?php echo $row['Phone']?> </td></tr>
                            <tr><td><h5>Address:</h5></td><td><?php echo $row['Address']?> </td></tr>
                            <?php
                        }
                        ?>



                    </table>

                    <p><button>Edit My Details</button></p>

                </form>
            </div>
        </div>
    </center>
    </body>
    </html>

<?php
}
else{

    echo "<script type='text/javascript'>alert('Please sign in.');window.location.href='signIn.php';</script>";
}
//echo $id;


?>



