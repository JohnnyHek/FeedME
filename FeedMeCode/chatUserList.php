<html>
<head>

    <link href="chatStyle.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript">

        var url = 'GetUserList.php';
        $(function () {
            get_list_reply(url);

        });

        function get_list_reply(url) {
            var setting = {
                url: url,
                data: {},
                type: 'post',
                dataType: 'json',
				
                success: function (response) {
                    //alert(response);
                    var res = response;
					
                    //if (res.status == 1) {
                        if (res!==null) {
                            var chatUsers = res;
                            var list ='';
                            list += '<div class="con2">';
                            list += '<div class="form2">';
                            list += '<div id="myTable" >';
                            list += '<table id = "output" class="output" >';
                            //list += '<div><tr><td><h5>Info</h5></td><td><h5>Chioce</h5></td></tr></div>';

                            for (var i in chatUsers) {
                                    list +='<div>';
                                    // list += '<div class="con2">';
                                    // list += '<div class="form3">';
                                    // list += '<div id="myTable">';
                                    // list += '<table id = "output" class="output" >';
                                    // list += '<div><tr><td><h5>Info</h5></td><td><h5>Chioce</h5></td></tr></div>';
                                    list += '<tr><td>';
                                    list += '<img src="user.png" style="width: 120px;height: 130px;"  alt="userpic" ></td>';
                                    list += '<td>';
                                    list += '<form name = "frm" method = "get" action = "chatWindow.php" onsubmit = "return tool()">';
                                    list += '<input type="hidden" value=" " name="hid" index='+chatUsers[i].ChatUserID +'>' ;
                                    list += '<input type="submit" class="btn" value="'+ chatUsers[i].ChatUserID +'  '+ chatUsers[i].Time +'">';
                                    list += '</form>'
                                    list += '</td></tr>';
                                    list += '</div>';
                                    // list += '</table></div></div></div>';
                            }
                            list += '</table></div></div></div>';
                            document.getElementById('listBox').innerHTML = list;
                            get_list_reply(url);
                        } else if (res.response_type == 'is_connecting') {

                        }
                        get_list_reply(url);
                    }
                //}
            }
            $.ajax(setting);
        }

    </script>

</head>
<body>
<center>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button"  value = "Home" onClick="javascript:location.href='index.php'"></h1></div>

<div id='listBox'>

</div>


<script>
    function tool() {
        var frm = window.event.srcElement;
        frm.hid.value = $(frm.hid).attr("index");
        return true;
    }
</script>
</center>
</body>
</html>