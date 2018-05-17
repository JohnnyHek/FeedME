<html>

<head>

    <title></title>
    <script src="jquery.min.js"></script>
    <script type="text/javascript">

        setInterval("getNum()",2000);
        function getNum () {
            $.ajax({
                type: 'post',
                url: 'GetNoticeNum.php',
                data: '',
                success: function (response) {
                    document.getElementById("noticeAlert").innerText=response;
                }

            });
        }
    </script>

</head>

<body>

<div id="noticeAlert">

</div>

</body>


