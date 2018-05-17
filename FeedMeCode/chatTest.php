<html>
<head>
    <script type = "text/javascript" src = "jquery.min.js"></script>
</head>
<body>


<form name = "frm" method = "get" action = "chatWindow.php" onsubmit = "return foo()">

    <input type="hidden" value=" " name="hid"  index="1">
    <input type="submit" value="chat with 1">

</form>
<form name = "frm" method = "get" action = "chatWindow.php" onsubmit = "return foo()">

    <input type="hidden" value=" " name="hid" index="2">
    <input type="submit" value="chat with 2">

</form>
<form name = "frm" method = "get" action = "chatWindow.php" onsubmit = "return foo()">

    <input type="hidden" value=" " name="hid" index="3">
    <input type="submit" value="chat with 3">

</form>

</body>
<script>
    function foo(){
        var frm = window.event.srcElement;
        frm.hid.value = $(frm.hid).attr("index");
        return true;
    }


</script>

</html>