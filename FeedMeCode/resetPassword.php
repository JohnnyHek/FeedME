<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>User reset password</title>
    <link href="FeedME.css" rel="stylesheet">

</head>

<body>


    <div class="title-page"> <h1 id="font1" >FeedME
    <input type="submit" value = "Home" onClick="javascript:location.href='index.php'"></h1></div>
    <div class="login-page">
        <div class="form">
            <form action="Question.php" method="post">
                <div ><label><h4>Username</h4></label>
                    <label><input type = "text" name = "userName" size = "40"></label></div>
                <label><h4>Answer following Question</h4></label>
                    <select name = "question" id="select" >
                        <option value = "1">Your mum's name</option>
                        <option value = "2">Your favourite fruit</option>
                        <option value = "3">Your puppy's color</option>
                    </select>
                <p><label><input type = "text" placeholder="Please choose one of them" name = "Q" size = "20"></label></p>

            <button >Submit</button>
            </form>

        </div>
    </div>



</body>
</html>
