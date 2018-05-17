<?php
session_start();
if (!empty($_SESSION["Favourite"])) {
    $selected_type = $_SESSION["Favourite"];
    $t = implode("##",$selected_type);
}
else{
    $t = null;
    $selected_type = null;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="FeedME.css" rel="stylesheet">
    <link href="background.css" rel="stylesheet">
    <title>FeedME</title>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            var r="<?php echo $t;?>";
           // var r = new Array();
          //  r =
          //  alert(r);
            var result = r.split("##");
            for(var i=0;i<result.length;i++){
                $("input[value='"+result[i]+"']").prop("checked",true);
            }
        });
        $(function () {


            $("#check").click(function () {

                var result = [];
                $("input[type='checkbox']").each(function(){
                    var num = this.checked ? 1 : 0;
                    result.push(num);
                });

                var res = result.join();
               // alert(res);
                window.location.href='editWish.php?arr='+ res;

            })

        })


    </script>

</head>
<body>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="button" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
</div>
<div class="sharing-page">
    <div class="form2">

<h2>My Wishlist</h2>
        <form>
        <p>

    <input type="checkbox" id="preference1" name="preference" value="Baking Supplies"/><label for="preference1">Baking Supplies</label>
        <input type="checkbox" id="preference2" name="preference" value="Biscuits & Crackers" /><label for="preference2">Biscuits & Crackers</label>
        <input type="checkbox" id="preference3" name="preference" value="Cereals & Breakfast Bars" /><label for="preference3">Cereals & Breakfast Bars</label>
        <input type="checkbox" id="preference4" name="preference" value="Condiments & Sauces" /><label for="preference4">Condiments & Sauces</label>
        <input type="checkbox" id="preference5" name="preference" value="Confectionery" /><label for="preference5">Confectionery</label>
        <input type="checkbox" id="preference6" name="preference" value="Cooking Ingredients" /><label for="preference6">Cooking Ingredients</label>
        <input type="checkbox" id="preference7" name="preference" value="Crisps & Snacks" /><label for="preference7">Crisps & Snacks</label>
        <input type="checkbox" id="preference8" name="preference" value="Dried Fruits, Nuts & Vegetables" /><label for="preference8">Dried Fruits, Nuts & Vegetables</label>
        <input type="checkbox" id="preference9" name="preference" value="Herbs, Spices & Seasonings" /><label for="preference9">Herbs, Spices & Seasonings</label>
        <input type="checkbox" id="preference10" name="preference" value="Instant Meals & Sides" /><label for="preference10">Instant Meals & Sides</label>
        <input type="checkbox" id="preference11" name="preference" value="Jams, Honey & Spreads" /><label for="preference11">Jams, Honey & Spreads</label>
        <input type="checkbox" id="preference12" name="preference" value="Meal Kits" /><label for="preference12">Meal Kits</label>
        <input type="checkbox" id="preference13" name="preference" value="Oils, Vinegars & Salad Dressings" /><label for="preference13">Oils, Vinegars & Salad Dressings</label>
        <input type="checkbox" id="preference14" name="preference" value="Rice, Pasta & Pulses" /><label for="preference14">Rice, Pasta & Pulses</label>
        <input type="checkbox" id="preference15" name="preference" value="Tinned & Jarred Food" /><label for="preference15">Tinned & Jarred Food</label>
        <input type="checkbox" id="preference16" name="preference" value="Soft drink" /><label for="preference16">Soft drink</label>
        <input type="checkbox" id="preference17" name="preference" value="Beer, Wine & Spirits" /><label for="preference17">Beer, Wine & Spirits</label>
        <input type="checkbox" id="preference18" name="preference" value="Fresh fruit & Vegetable" /><label for="preference18">Fresh fruit & Vegetable</label>
        <input type="checkbox" id="preference19" name="preference" value="Meat & Seafood" /><label for="preference19">Meat & Seafood</label>
    <br>

    <input type="button" id="check" style=" font-family: Roboto, sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 50%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all;
            transition: all;
            cursor: pointer;" value="Update">


        </p>
        </form>
    </div>
</div>
</body>
</html>