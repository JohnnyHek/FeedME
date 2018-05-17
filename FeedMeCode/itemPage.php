<?php
$str = $_SERVER["QUERY_STRING"]."";
$arr = explode("=",$str);
$f_id = $arr[1];
//echo $f_id;
session_start();
include("DBConnection.class.php");
$dbconn  = new DBConnection();
//for($i = 0; $i <obj.length; $i++){
//    echo $_SESSION["temp"][$i];
//}
if (!empty($_SESSION["userID"])) {
$user_id = $_SESSION["userID"];

$sql="SELECT * FROM Foods Where FoodID = '$f_id' ";
$res=$dbconn->query($sql);
//$row=$res->fetch_assoc;

if(!$dbconn){

    echo failed;

}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Item Page</title>
    <link href="FeedME.css" rel="stylesheet">

</head>
<script type="text/javascript" src="jquery.min.js"> </script>

<script type="text/javascript">
    function LikeAnItem(){
       
        var xhr = null;
        if (window.XMLHttpRequest) {    // Mozilla, Safari, ...
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) {    // IE 8 and older
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }else{
        }
        var foodID = <?php echo $f_id ?>;
       
        var data = "action=like&foodID="+foodID;
        xhr.open("POST", "ItemPageFunction.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
        xhr.onreadystatechange = display_data;
        function display_data() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    alert(xhr.responseText);

                } 
            } 
        }
    }
    function RequestAnItem(){
      
        var xhr = null;
        if (window.XMLHttpRequest) {    // Mozilla, Safari, ...
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) {    // IE 8 and older
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }else{
        }
        var foodID = <?php echo $f_id ?>;
        var userID = <?php echo $user_id ?>;
      
        var data = "action=request&foodID="+foodID+"&requesterID="+userID;
        xhr.open("POST", "ItemPageFunction.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
        xhr.onreadystatechange = display_data;
        function display_data() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    alert(xhr.responseText);

                }  
            } 
        }
    }
</script>


<body>
<center>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
<div class="con2">
<div class="sharing-pages">
    <div >
    <div class="form3">
        <div >
    <table id="myTable" border="0" table align="center">
        <?php
        while($row=$res->fetch_assoc()){
        //echo base64_decode($row['File']);
        ?>

        <tr>
            <td rowspan="2"><img width="150" height="100" src='data:image;base64,<?php echo $row['Image']?> '></td>
            <td><h4>Name: <?php echo $row['FoodName']?> </h4></td>
        </tr>
        <tr>
            <td><input type="button"  value="Like"  class="btn" onClick="LikeAnItem()">
                <form name="frm" method="get" action="chatWindow.php" onsubmit="return message()">
                    <input type="hidden" value="Message" name="hid" index="<?php echo $row['SharerID'];?>">
                    <input class="btn" type="submit"  value="Message">
                </form>

                <input type="button" class="btn" value="Request"  onClick="RequestAnItem()">
            </td>
        </tr>
    </table>
    <br>
    <table border="0" table align="center">

        <tr><td><h5>Type: </h5></td><td><?php echo $row['FoodType']?></td></tr>
        <tr><td><h5>Quantity: </h5></td><td><?php echo $row['Quantity']?></td></tr>
        <tr><td><h5>Description: </h5></td><td><?php echo $row['FoodDescription']?></td></tr>
        <tr><td><h5>File: </h5></td><td><?php echo base64_decode($row['File']);?></td></tr>
        <tr><td><h5>Location: </h5></td><td><?php echo $row['LocationX']?>, <?php echo $row['LocationY']?>
			<script>
				function initMap(){
				var positionX = <?php echo $row['LocationX']?>;
				var positionY = <?php echo $row['LocationY']?>;
			
				var map = new google.maps.Map(document.getElementById('map'), {
          		center: {lat: positionX, lng: positionY},
          		zoom: 14
        		});
				var marker = new google.maps.Marker({ 
					position: new google.maps.LatLng(positionX, positionY),
					map: map 
				}); 
	}
			</script>
       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl2mwb_nClG3OQu8lOk3Z8h0g8fXFgBA4"
  type="text/javascript"></script>
        
        <div id="map" style="width: 200px;height: 200px;"><button onclick="initMap();">Display</button></div></td></tr>
        <?php
        }
        ?>
    </table>
    </div>
    </div>
    </div>
    </div>
</div>
<script>

    function message(){
        var frm =window.event.srcElement;
        frm.hid.value = $(frm.hid).attr("index");
        return true;
    }
</script>
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