<?php
$num_rec_per_page = 5;
include("DBConnection.class.php");
$dbconn  = new DBConnection();
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
else{
    $page  =1;
};
$start_from = ($page-1)*$num_rec_per_page;
$sql = "SELECT * FROM Foods WHERE Status = 1 LIMIT $start_from,$num_rec_per_page";
$res=$dbconn->query($sql);
$row=$res->fetch_assoc;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="FeedME.css" rel="stylesheet"> 
    <title>FeedME</title>
    <script type="text/javascript" src="jquery.min.js"> </script>
    <script type="text/javascript" src="search2.js"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl2mwb_nClG3OQu8lOk3Z8h0g8fXFgBA4"
  type="text/javascript"></script>  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl2mwb_nClG3OQu8lOk3Z8h0g8fXFgBA4&libraries=geometry"></script>
    <script type="text/javascript">

        setInterval("getNum()",2000);
        function getNum () {
            $.ajax({
                type: 'post',
                url: 'GetNoticeNum.php',
                data: { },
                success: function (responsedata) {
                    var html='';
                    var notice = "Notification(" + responsedata + ")";
                    html += "<input type=\"button\" class=\"button\"  onclick=\"window.location.href='NoticeDetail.php'\" value=" + notice + ">";
                    document.querySelector(".noticeAlert").innerHTML = html;
                   // document.getElementById("noticeAlert").innerText=html;
                }

            });
        }
    </script>

</head>


<body>

<div class="title-page">
    <table style="width: 100%;">
        <tr>
            <td>
                <div>
                    <h1 id="font1" >FeedME
                        <input type="submit" value = "Home" class="button" onClick="javascript:location.href='index.php'"></h1>
                </div>
            </td>
            <td style="margin: 3% 70%; text-align: right" >

                    <select name="myAccount" onchange="window.location=this.value;">
                        <option hidden>My Account</option>
                        <option value="signIn.php" class="op1">Sign in</option>
                        <option value="register.php" class="op1">Register</option>
                        <option value="myAccount.php" class="op2">My Profile</option>
                        <option value="mySharing2.php" class="op2">My Sharing</option>
                        <option value="chatUserList.php" class="op2">Message</option>
                        <option value="wishList.php" class="op2">Wish List</option>
                        <option value="signout.php" class="op2">Sign out</option>
                    </select>

            </td>
            <td style="margin: 3% 55%">
                <div id="noticeAlert" class="noticeAlert"  float="right">
                    <input type="button" value="Notification" class="button" onclick="window.location.href='NoticeDetail.php'">
                </div>
            </td>

        </tr>



    </table>
</div>


<div class="content">

    <div class="con2">
        <div id=""> <span><input type="text" placeholder="Name" id="FoodName" class="text"></span>
            <span>
            <select name="type" id="FoodType">
    <option value="">Type</option>
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
        </span>
        <span><input type="text" placeholder="Quantity" id="Quantity" class="text"></span>
        <span><input type="text" placeholder="Location" id="Location" class="text"></span>
        <span><button type="button" class="button" onClick="doSearch()">Search</button></span>
        </div>
    </div>

    <div class="con2">
    <span>
        <select name="sort" id="sortRes" onchange="sorting(this.value)">
            <option hidden>Sorting</option>
            <option id="ReleaseDate" class="ReleaseDate">Latest release</option>
            <option>Most popular</option>

        </select>
    </span>

        <span>
        <select name="filter" onchange=filtering(this.value)>
            <option hidden>Filter</option>
            <option>Release within 1 day</option>
            <option>Release within 3 days</option>
            <option>Release within 5 days</option>
            <option>Location within 500m</option>
            <option>Location within 1km</option>
            <option>Location within 3km</option>
        </select>
    </span>
    <span>
    		<button type="button" class="button" onClick="showInAMap();">Show In a Map</button>
    	</span>
    </div>

    <div class="con2">
        <div class="form3">
           <div id="showMap"></div>
            <div id="myTable">
            <table id = "output" class="output" >
                <div><tr><td><h5>Photo</h5></td><td><h5>FoodName</h5></td><td><h5>Quantity</h5></td></tr></div>
                <?php
                while($row=$res->fetch_assoc()){
                    ?>
                    <script>
                        function tool1() {
                            var frm = window.event.srcElement;
                            frm.hid.value = $(frm.hid).attr("index");
                            return true;

                        }
                    </script>

                    <tr><td><img width="100" height="66" src='data:image;base64,<?php echo $row['Image']?> '></td>

                        <td>
                            <form class= "name" method = "get" action = "itemPage.php" onsubmit="return tool1()">
                                <input type="hidden" value=" " name="hid" index="<?php echo $row['FoodID'];?>">
                                <input type="submit" class="btn" value="<?php echo $row['FoodName'];?>">
                            </form>
                        </td>
                        <td><?php echo $row['Quantity']?></td>
                    </tr>
                    <?php
                }
                ?>

            </table>
                <div  id="page">
                <?php
                session_start();
                $_SESSION['foodID']=$FoodID;
                $sql="SELECT * FROM Foods ";
                $res=$dbconn->query($sql);
                $total_records = mysqli_num_rows($res);
                $total_pages = ceil($total_records/ $num_rec_per_page);
                echo "<a href='index.php?page=1'>".'|< '."</a> ";

                for($i =1; $i<= $total_pages;$i++){
                    echo "<a href='index.php?page=".$i."'>".$i."</a> ";
                };
                echo "<a href='index.php?page=$total_pages'>".' >| '."</a> ";
                ?>
                </div>

            </div>
        </div>


    </div>

</div>
</div>
</body>
</html>

