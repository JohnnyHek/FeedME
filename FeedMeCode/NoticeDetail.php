<?php
session_start();
if (!empty($_SESSION["userID"])) {
//$id  = $_SESSION["userID"];
?>



<html>
<head>
    <script type="text/javascript" src="jquery.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="chatStyle.css" rel="stylesheet">

</head>

<body>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button"  value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-2 column">
        </div>
        <div class="col-md-8 column">
            <div id="notificationBox"> <div>
        </div>
        <div class="col-md-2 column">
        </div>
    </div>
</div>



        <script type="text/javascript">

            var url = 'GetNoticeDetail.php';
            $(function () {
                get_notice_reply(url, 'get_notice', '');

            });


            function get_notice_reply(url, request_type, send_data) {
                var setting = {
                    url: url,
                    data: {
                        request_type: request_type,
                        send_data: send_data,
                    },
                    type: 'post',
                 //   dataType: 'json',
                    
                    success: function (response) {
						//alert(response);
						//var res=response;
                        var res =JSON.parse(response);
                        //if (res.status == 1) {
                            if (res!==null) {

                                var notice = res;
                                var notice_str = '';
                                var id_arr = new Array();
                                for (var i in notice) {
                                    id_arr.push(notice[i]['ID']);
                                    if(notice[i].type==1){
                                        notice_str += '<div class="notice_con">';
                                        notice_str += '<div>'+'<li>'+notice[i]['Notification']+'</li>'+'<div>';
                                        notice_str += '<form name = "frm" method = "get" action = "ItemPage.php" onsubmit = "return tool()">';
                                        notice_str += '<input type="hidden" value="" name="hid" index='+notice[i].FoodID +'>' ;
                                        notice_str += '<input type="submit" value="More information" class="notice_but">';
                                        notice_str += '</form>';
                                        notice_str += '</div>';
                                    }
                                    else if(notice[i].type==2){
                                        notice_str += '<div class="notice_con">';
                                        notice_str += '<div>'+'<li>'+notice[i]['Notification']+'</li>'+'<div>';
                                        notice_str += '</div>';
                                    }
                                }
                                $('#notificationBox').append(notice_str);

                                get_notice_reply(url, 'comfirm_read', id_arr);
                            } else{

                                get_notice_reply(url, 'get_notice', '');
                            }
                        }
                    //}
                };
                $.ajax(setting);
            }
        </script>
        <script>
            function tool() {
                var frm = window.event.srcElement;
                frm.hid.value = $(frm.hid).attr("index");
                return true;
            }
        </script>

</body>

</html>

    <?php

}
else{

    echo "<script type='text/javascript'>alert('Please sign in.');window.location.href='signIn.php';</script>";
}
?>