<?php
$food_id = $_POST['FoodID'];
//echo $id+"done";
//$action = $_POST['action'];
session_start();
//$_SESSION['idselected'] = $id;
include("DBConnection.class.php");
$dbConn = new DBConnection();
$sql = "select * from Foods where FoodID = '$food_id'";
$result = $dbConn->query($sql);
$row = $result->fetch_assoc();
if (!empty($_SESSION["userID"])) {
    $id  = $_SESSION["userID"];}
else{
    $id = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="FeedME.css" rel="stylesheet">

    <title>FeedME</title>
    <script>
       var positionX;
        var positionY;
     //   var location = 0;
        function getCurrentLocation(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var coords = position.coords;
                    positionX = position.coords.latitude;
                    positionY = position.coords.longitude;
                    alert("Position Get !");
                //    location = 1;


                }, function(error) {
                    alert("Please allow location access!");
                });
            } else {
                // Browser doesn't support Geolocation
                alert("This browser is not fit!");
               // location = 0;
            }
        }

        function edit() {
            var foodID =  <?php echo $food_id?>;
            var sharerID = <?php echo $id?>;
            var foodName = document.getElementById("foodName");
            var foodType = document.getElementById("foodType");
            var foodDescription = document.getElementById("foodDescription");
            var quantity = document.getElementById("quantity");
            var status = document.getElementById("status");
           // alert(foodID);

            //var outputResult = "YeahBuddy!";
       //     if(foodName.value.replace(/(^\s*)|(\s*$)/g, "") === ""||foodType.value.replace(/(^\s*)|(\s*$)/g, "") === ""||foodDescription.value.replace(/(^\s*)|(\s*$)/g, "") === ""||quantity.value.replace(/(^\s*)|(\s*$)/g, "") === ""){
       //     }
        //    else{
                var xhr = null;
                if (window.XMLHttpRequest) {    // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) {    // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }else{
                }
                var data = "action=editItem"+"&sharerID="+sharerID+"&foodName="+foodName.value+"&foodType="+
                    foodType.value+"&foodDescription="+foodDescription.value+ "&quantity="+quantity.value+"&locationX="+positionX+"&locationY="+positionY+
                "&foodID="+foodID+"&status="+status.value;
                //+"&location="+location
              //  alert(data);
                xhr.open("POST", "manageItem2.php", true);
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
      //  }

    //    }
    </script>

</head>
<body>
<center>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
<div class="con2">
    <div class="sharing-page">
        <div class="form1">
<h2>Edit Item</h2>
<p>Please enter the details that you want to edit.</p>


            <table id="myTable" style=" margin: 0 auto; ">
                <tr>
                    <td><label for="Name">Name</label></td>
                    <td><input type="text" class="text" name="foodName" id="foodName" value="<?php echo $row["FoodName"]; ?>" placeholder="<?php echo $row["FoodName"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="Type">Type</label></td>
                    <td><select name="type" id="foodType" value=<?php echo $row["FoodType"]; ?>>
                            <option value=<?php echo $row["FoodType"]; ?>><?php
                                $arr = array("Baking Supplies","Biscuits & Crackers","Cereals & Breakfast Bars","Condiments & Sauces","Confectionery","Cooking Ingredients",
            "Crisps & Snacks","Dried Fruits, Nuts & Vegetables","Herbs, Spices & Seasonings","Instant Meals & Sides","Jams, Honey & Spreads",
            "Meal Kits","Oils, Vinegars & Salad Dressings","Rice, Pasta & Pulses","Tinned & Jarred Food","Soft drink","Beer, Wine & Spirits","Fresh fruit & Vegetable","Meat & Seafood");
                                $foodtype = $arr[$row["FoodType"]-1];
                                echo $foodtype;
                                ?></option>
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
                    </td>
                </tr>

                <tr><td><label for="Description">Description</label></td>
                    <td><input type="text" class="text" name="foodDescription" id="foodDescription" value="<?php echo $row["FoodDescription"]; ?>" placeholder="<?php echo $row["FoodDescription"]; ?>"></td>
                </tr>

                <tr>
                    <td><label for="quantity">Quantity</label></td>
                    <td><select name="quantity" id = "quantity" value=<?php echo $row["Quantity"]; ?>>
    <option><?php echo $row["Quantity"]; ?></option>
    <script>
        for(var i=1;i<=20;i++){
            document.write("<option value='"+i+"'>"+i+"</option>");
        }
    </script>

</select>Quantity no more than 20.
                    </td>
                </tr>

                <tr>
                    <td><label for="status">Status</label></td>
                    <td>
<select name="status" id = "status" value=<?php echo $row["Status"]; ?>>
    <option value=<?php echo $row["Status"]; ?>><?php
        if($row["Status"]==1){
            echo "Available";
        }else{
            echo "Not Available";
        }
        //echo $row["Status"];
        ?></option>
    <option value="1">Available</option>
    <option value="0">Not Available</option>
</select>
                    </td>
                </tr>
                <p><button type="button" class="button" onClick="getCurrentLocation();">getCurrentLocation</button></p>
            </table>
                <button type="button" class="button" onClick="edit();">Edit Item</button>

        </div>
    </center>
</body>
</html>