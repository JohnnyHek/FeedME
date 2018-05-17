<?php
session_start();
if (!empty($_SESSION["userID"])) {
$id  = $_SESSION["userID"];}
else{
    $id = null;
}
?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link href="FeedME.css" rel="stylesheet">

    <title>addItem</title>
<script src="jquery.min.js"></script>
    <script>
        var positionX;
        var positionY;
        function getCurrentLocation(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var coords = position.coords;
                    positionX = position.coords.latitude;
                    positionY = position.coords.longitude;
                    alert("Position Get !");


                }, function(error) {
                    alert("Please allow location access!");
                });
            } else {
                // Browser doesn't support Geolocation
                alert("This browser is not fit!");
            }
        }

        function getSearchLocation(){
            var address = document.getElementById("location").value;

        
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address' : address },
                function(results, status) {
                 
                    if (status == google.maps.GeocoderStatus.OK) {

                   
                        var coords = results[0].geometry.location;

                     
                        positionX =  results[0].geometry.location.lat();
                        positionY = results[0].geometry.location.lng();
                   

                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
        }

        function add(){

	var sharerID = <?php echo $id?>;

	var foodName = document.getElementById("foodName");
	var foodType = document.getElementById("foodType");
	var foodDescription = document.getElementById("foodDescription");
	var quantity = document.getElementById("quantity");


	//var outputResult = "YeahBuddy!";
	if(foodName.value.replace(/(^\s*)|(\s*$)/g, "") === ""||foodType.value.replace(/(^\s*)|(\s*$)/g, "") === ""||foodDescription.value.replace(/(^\s*)|(\s*$)/g, "") === ""||quantity.value.replace(/(^\s*)|(\s*$)/g, "") === ""){
	    alert("Please fill in the information with *.");
	}
	else{
		var xhr = null; 
     if (window.XMLHttpRequest) {    // Mozilla, Safari, ...
           xhr = new XMLHttpRequest();
     } else if (window.ActiveXObject) {    // IE 8 and older
           xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
    }
    var data = "action=addItem"+"&sharerID="+sharerID+"&foodName="+foodName.value+"&foodType="+
		foodType.value+"&foodDescription="+foodDescription.value+ "&quantity="+quantity.value+"&locationX="+positionX+"&locationY="+positionY;
	//alert(data);
    xhr.open("POST", "manageItem2.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
   xhr.send(data);
   xhr.onreadystatechange = display_data;
   function display_data() {
   if (xhr.readyState == 4) {
          if (xhr.status == 200) {
              alert(xhr.responseText);
			  
         }  else {
               
              }
   } else{
     
   }
   }
	}
		}


    </script>

</head>
<body>
<center>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button"  value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
<div class="con2">
    <div class="sharing-page">
        <div class="form1">
<h2>Add Item</h2>
<p>Please complete the information with *.</p>

                <div class="" >
                    <div class="div-inline">
                    <form enctype="multipart/form-data" method="post" action="image.php">
                        <label for="image">Photo</label>

                        <input id="image" name="image" type="file" >
                        <input type="text" id="action" name="action" value="add" hidden>
                        <input type="submit" name="upload" class="button" value="Upload Image">
                    </form>
                    </div>
                    <p></p>
                    <div class="div-inline">
                    <form enctype="multipart/form-data" method="post" action="image.php">
                        <label for="file">File</label>
                        <input id="file" name="file" type="file" />
                        <input type="text" id="action" name="action" value="add" hidden>
                        <input type="submit" name="upload" class="button" value="Upload File">
                    </form>
                    </div>
                    <p></p>

                    <table id="myTable" style=" margin: 0 auto; ">
                        <tr>
                            <td><label for="Name">Name*</label></td>
                            <td><input type="text" class="text" name="foodName" id="foodName"></td>
                        </tr>


                        <tr>
                            <td><label for="Type">Type*</label></td>
                            <td>

                        <select name="type" id="foodType" >
                            <option>Type</option>
                            <option value="1">Baking Supplies</option>
                            <option value="2">Biscuits & Crackers</option>
                            <option value="3">Cereals & Breakfast Bars</option>
                            <option value="4">Condiments & Sauces</option>
                            <option value="5">Confectionery</option>
                            <option value="6">Cooking Ingredients</option>
                            <option value="7">Crisps & Snacks</option>
                            <option value="8">Dried Fruits, Nuts & Vegetables</option>
                            <option value="9">Herbs, Spices & Seasonings</option>
                            <option value="10">Instant Meals & Sides</option>
                            <option value="11">Jams, Honey & Spreads</option>
                            <option value="12">Meal Kits</option>
                            <option value="13">Oils, Vinegars & Salad Dressings</option>
                            <option value="14">Rice, Pasta & Pulses</option>
                            <option value="15">Tinned & Jarred Food</option>
                            <option value="16">Soft drink</option>
                            <option value="17">Beer, Wine & Spirits</option>
                            <option value="18">Fresh fruit & Vegetable</option>
                            <option value="19">Meat & Seafood</option>
                        </select>
                            </td></tr>

                        <tr>
                            <td><label for="Description">Description*</label></td>
                            <td><input type="text"  class="text" name="foodDescription" id="foodDescription"></td>
                        </tr>

                        <tr>
                            <td><label for="quantity">Quantity*</label></td>
                            <td><select name="quantity" id = quantity>
                            <script>
                                for(var i=1;i<=20;i++){
                                    document.write("<option value='"+i+"'>"+i+"</option>");
                                }
                            </script>
                                </select>(Quantity no more than 20.)
                            </td>
                        </tr>


                        <p><button type="button" class="button" onClick="getCurrentLocation();">getCurrentLocation*</button></p>

                    <tr>
                        <td><label for="location">Search a Location*</label></td>
                        <td><input type="text" class="text" name="location" id="location">
                        <button type="button" class="button" onClick="getSearchLocation();">Search Location*</button>
                        </td>
                    </tr>
                </table>

                    <button type="button" class="button" onClick="add();">Add Item</button>
                </div>





                </center>
</body>
</html>