<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="FeedME.css" rel="stylesheet">
    <title>Register</title>
    <script type="text/javascript">
        function inserManager() {
            var password = document.getElementById("Password1").value;
            var repassword = document.getElementById("Password2").value;
                if(password!=repassword){
                    window.alert("Please input the same password");
                    regForm.repassword.focus();
                    return false;
                }
                return true;

        }
    </script>

</head>
<body>
<div class="title-page"> <h1 id="font1" >FeedME
        <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>

<div class="login-page">
    <div class="form">
    <form id="regForm" name = "regForm" action="reg-guest.php" method="post">
        <label for="Username"><h4>Username</h4></label>
        <input type="text" name="Username"><label for="Password1"><h4>Password</h4></label>
        <input type="password" name="Password1"><label for="Confirm Password"><h4>Confirm Password</h4></label>
        <input type="password" name="Password2"><label for="Email"><h4>Email</h4></label>
        <input type="Email" name="Email"><label for="Phone"><h4>Phone number</h4></label>
        <input type="text" name="Phone"><label for="Address"><h4>Address</h4></label>
        <input type="text" name="Address"><label for="Address"><h4>Question</h4>
        <select name = "question" id="select" >
            <option value = "1">Your mother's name</option>
            <option value = "2">Your favourite fruit</option>
            <option value = "3">Your puppy's color</option>
        </select>
        <input type = "text" placeholder="Please choose one of them" name = "Q" size = "20"></label>

    <button onclick="inserManager()">Register</button>

</form>
    </div>
</div>



</body>
</html>