<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="background.css" rel="stylesheet">

    <title>FeedME</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl2mwb_nClG3OQu8lOk3Z8h0g8fXFgBA4"
  type="text/javascript"></script>
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
					alert(positionX);
					alert(positionY);


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

			alert(address);
			var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address' : address }, 
			function(results, status) { 
				alert("waduhek");
                if (status == google.maps.GeocoderStatus.OK) {    

					alert("can search");
					var coords = results[0].geometry.location;
					
					alert(coords);
					positionX =  results[0].geometry.location.lat();
            		positionY = results[0].geometry.location.lng();
            		alert(positionX);
					alert(positionY);
                       
                } else {    
                    alert("Geocode was not successful for the following reason: " + status);    
                }    
            });
		}

        function add(){

	//var sharerID = 1;
	var foodName = document.getElementById("foodName");
	var foodType = document.getElementById("foodType");
	var foodDescription = document.getElementById("foodDescription");
	var quantity = document.getElementById("quantity");


	//var outputResult = "YeahBuddy!";
	if(foodName.value.replace(/(^\s*)|(\s*$)/g, "") === ""||foodType.value.replace(/(^\s*)|(\s*$)/g, "") === ""||foodDescription.value.replace(/(^\s*)|(\s*$)/g, "") === ""||quantity.value.replace(/(^\s*)|(\s*$)/g, "") === ""){
	}
	else{
		var xhr = null; 
     if (window.XMLHttpRequest) {    // Mozilla, Safari, ...
           xhr = new XMLHttpRequest();
     } else if (window.ActiveXObject) {    // IE 8 and older
           xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
    }
    var data = "action=addItem&sharerID=1&foodName="+foodName.value+"&foodType="+
		foodType.value+"&foodDescription="+foodDescription.value+ "&quantity="+quantity.value+"&locationX="+positionX+"&locationY="+positionY;
	alert(data);
    xhr.open("POST", "manageItem2.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
   xhr.send(data);
   xhr.onreadystatechange = display_data;
   function display_data() {
   if (xhr.readyState == 4) {
          if (xhr.status == 200) {
			  alert(xhr.responseText);
			  
         }  else {
                   alert("status="+xhr.status);   }
   } else{alert("readystate"+xhr.readyState);}  
   }
	}
		}


    </script>

</head>
<body>
<h1>FeedME <input type="button" value = "Home" onClick="javascript:location.href='index.php'"></h1>
<h2>Add Item</h2>
<p>Please complete the information with *.</p>
<form enctype="multipart/form-data" method="post" action="image.php">
    <label for="image">Photo</label>
    <input id="image" name="image" type="file" />
    <input type="submit" name="upload" value="Upload Image">
</form>

<form enctype="multipart/form-data" method="post" action="image.php">
    <label for="file">File</label>
    <input id="file" name="file" type="file" />
    <input type="submit" name="upload" value="Upload File">
</form>


    <label for="Name">Name*</label>
    <input type="text" name="foodName" id="foodName">
    <label for="Type">Type*</label>
    <select name="type" id="foodType">
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

    <label for="Description">Description*</label>
    <input type="text" name="foodDescription" id="foodDescription">
    <label for="quantity">Quantity*</label>
    <select name="quantity" id = quantity>
        <script>
            for(var i=1;i<=20;i++){
                document.write("<option value='"+i+"'>"+i+"</option>");
            }
        </script>

    </select>Quantity no more than 20.


<button type="button" onClick="getCurrentLocation();">getCurrentLocation*</button>
<label for="location">Search a Location*</label>
    <input type="text" name="location" id="location">
<button type="button" onClick="getSearchLocation();">Search Location*</button>
<button type="button" onClick="add();">Add Item</button>







</body>
</html>