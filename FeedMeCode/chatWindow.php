
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="chatStyle.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript">
        var chatUserID = window.location.href.split('=')[1] ;
        $(function () {
            $('#talkSub').on('click', function () {
                var message_text = $('#talkWords').val();
                if (message_text != '') {

                    var message_str = '<li style="text-align: right;padding-right: 10px;">';
                    message_str += 'You：' + message_text;
                    message_str += '</li>';
                    $('#talkWords').val('');
                    $('#words').append(message_str);


                    var send_url = 'SendMessage.php';
                    var send_data = {
                        message: message_text,
                        chatUserID: chatUserID
                    };

                    /*$.post(send_url, send_data, function (response) {
						
                        if (response !== 1) {
                            console.log('Failed!');
                        }
                    }, 'json');*/
                    $.ajax({
                        url: send_url,
                        data: send_data,
                        type: 'post',
                        success: function (responsedata) {
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.readyState);
                            alert(textStatus)
                        },
                     
                    });
                }
            });
        });

    </script>

</head>
<body>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button"  value = "Home" onClick="javascript:location.href='index.php'"></h1></div>



<div class="container">
    <div class="row clearfix">
        <div class="col-md-2 column">
        </div>
        <div class="col-md-8 column">

            <div class="talk_con">
                <div class="talk_show" id="words">

                </div>
                <div class="talk_input">
                    <div> Please enter words:</div>
                    <input type="text" class="talk_word" id="talkWords" maxlength="40">
                    <input type="button" value="send" class="talk_sub" id="talkSub">
                </div>

            </div>
        </div>
        <div class="col-md-2 column">
        </div>
    </div>
</div>
<!--<script type="text/javascript">


    var chatUserID = window.location.href.split('=')[1];
    var url = 'GetMessage.php';
    $(function () {
        get_message_reply(url, chatUserID, 'get_message', '');
    });


    function get_message_reply(url, chatUserID, request_type, send_data) {
        var setting = {
            url: url,
            data: {
                request_type: request_type,
                chatUserID: chatUserID,
                send_data: send_data,
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {

                if (response.status == 1) {
                    if (response.response_type == 'is_read') {
                        var messages = response.info;
                        var message_str = '';
                        var id_arr = new Array();
                        for (var i in messages) {
                            id_arr.push(messages[i]['ChatID']);
                            message_str += '<li>' + messages[i]['ChatUserID'] + '  ' + messages[i]['Time'] + '：' + messages[i]['Text'] + '</li>';
                        }
                        $('#words').append(message_str);

                        get_message_reply(url, chatUserID, 'comfirm_read', id_arr);
                    } else if (response.response_type == 'is_connecting') {
                        get_message_reply(url, chatUserID,'get_message', '');
                    }
                }
            }
        };
        $.ajax(setting);
    }
</script>-->
<script type="text/javascript">
    var chatUserID = window.location.href.split('=')[1];

    setInterval("getMes()",2000);
    /*var data={
            chatUserID: chatUserID
        },
    function getMes (){
        xhr.open("POST", "GetMessage2.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
        xhr.onreadystatechange = display_data;
        function display_data() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var messages = response.info;
                    var message_str = '';
                    for (var i in messages) {
                        message_str += '<li>' + messages[i]['ChatUserID'] + '  ' + messages[i]['Time'] + '：' + messages[i]['Text'] + '</li>';
                    }
                    $('#words').append(message_str);
                }  else {
                    alert("status="+xhr.status);   }
            } else{alert("readystate"+xhr.readyState);}
        }


    }*/
    function getMes () {
        $.ajax({
            type: 'post',
            url: 'GetMessage2.php',
            data: {
                chatUserID: chatUserID
            },
            
            success: function (response) {
				
                var messages = JSON.parse(response);
                var message_str = '';
                for (var i in messages) {
                    message_str += '<li>' + messages[i]['ChatUserID'] + '  ' + messages[i]['Time'] + '：' + messages[i]['Text'] + '</li>';
                }
                $('#words').append(message_str);
            },

            error: function (jqXHR, textStatus, errorThrown,response) {
                alert(jqXHR.readyState);
                alert(textStatus);
                alert(errorThrown);
                alert(response);
                console.log(errorThrown);
            },

        });
    }
</script>

</body>
</html>