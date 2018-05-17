<?php
session_start();
if (!empty($_SESSION["userID"])) {
$id  = $_SESSION["userID"];

?>


<!doctype html>
<html>
<head>

    <title>User sharing item details</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="jquery.min.js"></script>
    <link href="FeedME.css" rel="stylesheet">


    <script>
        var sharerID = "<?php echo $id;?>";
        function presentrecord() {
           // alert("click");

            var action1 = "viewPresentItem";
            view(action1,sharerID);
        }

        function passrecord() {
        //    alert("clickpass");
            var action2 = "viewPastItem";
            view(action2,sharerID);
        }

        function view(action,sharerID) {

            $.ajax({
                url: "manageItem2.php",
                type: "POST",
                data: {action: action,sharerID:sharerID},
                dataType: "json",
                // alert("ok");
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.readyState);
                    alert(textStatus)
                },

                success: function (resultshown) {
                //    alert("ok");
                    var display="";
                    if(action =="viewPresentItem"){
                        display = ".now";
                    }
                    else{
                        display = ".pass";
                    }
                    //alert(display);
                    var result = resultshown;
                   // alert(resultshown);
                    var name = new Array();
                    var photo = new Array();
                    var id = new Array();
                    for (var j = 0; j < result.length; j++) {
                        name[j] = result[j].FoodName;
                        photo[j] = result[j].Image;
                        id[j] = result[j].FoodID;
                    }

                  //  alert(id);
                    var html = '';
                    for (var i = 0; i < name.length; i++) {
                        html += '<tr>';


                        html += '<td>' + "<img width=\"100\" height=\"66\" src='data:image;base64," + photo[i] + "'>" + '</td>';
                        html += '<td>' + name[i] + '</td>';
                        html += '<td>' + "<input type=\"radio\" name=\"select\" id=" + id[i] + " >" + '</td>';
                        html += '</tr>';
                    }
                    //alert(display);
                    document.querySelector(display).innerHTML = html;

                }
            })
            //return html;
        }


        function edit(){
            var idselect = $("[name='select']").filter(":checked");
            var idselected = idselect.attr("id");
            //  var idselect = document.getElementById("select");
            alert(idselected);
            var flag;
            if(idselected!= null){
                document.getElementById("FoodID").value = idselected;
                flag = true;

            }else{

                alert("Please select an item.");
                flag = false;
            }
            return flag;

        }

        function remove() {
            var idselect = $("[name='select']").filter(":checked");
            var idselected = idselect.attr("id");
            //  var idselect = document.getElementById("select");
         //   alert(idselected);
            //var flag;
            var action = "deleteItem";
            if(idselected!= null){
                $.ajax({
                    url: "manageItem2.php",
                    type: "POST",
                    data: {foodID: idselected,action:action},
                    dataType: "json",
                    // alert("ok");
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(jqXHR.readyState);
                        alert(textStatus)
                    },

                    success: function (resultshown) {
                        alert("Remove successfully");
                        var result = resultshown;
                      // alert(result);
                       var status = new Array();
                        for (var j = 0; j < result.length; j++) {
                            status[j] = result[j].Status;

                        }
                      //  alert(status[0]);
                        if(status[0]=="1"){
                            presentrecord();
                        }
                        else{
                            passrecord();
                        }
                      //  window.location.href="editItem.php";
                    }
                })
            }
            else{
                alert("Please select an item.");
            }
        }


    </script>
</head>

<body>
<center>
    <div class="title-page"> <h1 id="font1" >FeedME
            <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
    <div class="con2">
        <div class = "sharing-page">
            <div class = "form1">
    <p><label><h3>My Sharing</h3></label></p>
                <input type="button"  value="Add " class="button" onClick="javascript:location.href='addItem2.php'">

    <form method="post" action="editItem.php" class = "div-inline" onclick="return edit()">
        <input type="text" id="FoodID" name="FoodID" value="" hidden>
        <input type="submit" class="button" value="Edit">
    </form>

                <input type="button" class="button" value="Remove" class = "div-inline" onClick="remove()">
                <div class="con1"></div>

                <div >
    <p><label><h4>Present Records</h4></label></p>

    <button type="button" class="button" id="Present" onclick="presentrecord()">Present</button>
    <table class="now" id="myTable" style=" margin: 0 auto; " >

    </table >
    <p><label><h4>Past Records</h4></label></p>
    <button type="button" class="button" id="Passrecord" onclick="passrecord()">Past</button>
    <table class="pass" id="myTable" style=" margin: 0 auto; ">
                </div>


    </table>
            </div>
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
    ?>