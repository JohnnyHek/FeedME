<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>User sign in</title>
    <link href="FeedME.css" rel="stylesheet">

</head>

<body>

    <div class="title-page"> <h1 id="font1" >FeedME
            <input type="submit" class="button" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>


    <div class="login-page">
    <div class="form">
    <form action="signincheck.php" method="post">

        <p><div ><label><h4>Username</h4></label>
            <label><input type = "text" name = "Nickname" size = "40"></label></div></p>
        <p><div><label><h4>Password  </h4></label>
            <label><input type = "password" name = "Password" size = "40"></label></div></p>
        <p><div><button>Sign In </button>
            <b><a href="resetPassword.php" target="_blank"><u>Forgotten Password? </u></a></b></div></p>
    </form>
    </div>
    </div>

</body>
</html>
